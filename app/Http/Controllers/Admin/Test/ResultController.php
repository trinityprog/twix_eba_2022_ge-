<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\TestResultFilter;
use App\Models\TestAnswers;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Str;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $results = TestResult::with('answers')
            ->filter($request->all(), TestResultFilter::class)
            ->get();

        return view('admin.test.results.index', compact('results'));
    }

    public function edit($id)
    {
        $result = TestResult::findOrFail($id);
        $answers = TestAnswers::all();

        return view('admin.test.results.edit', compact('result', 'answers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'general' => 'required',
            'answers' => 'array|min:3|max:3'
        ]);

        $result = TestResult::findOrFail($id);
        $result->update($request->only('general', 'locale'));

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('i/test/results'), $imageName);

            $result->update([
                'image' => $imageName
            ]);
        }

        if($request->has('answers')) {
            $result->answers()->sync($request->input('answers'));
        }

        return redirect(route('admin.tests.results.index'))->with('message', 'Результат #'.$id.' обновлен!');
    }
}
