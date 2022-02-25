<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\TestQuestion;
use Illuminate\Http\Request;
use Str;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = TestQuestion::with('variant')
            ->withCount('answers')
            ->get();


        return view('admin.test.questions.index', compact('questions'));
    }

    public function edit($id)
    {
        $question = TestQuestion::findOrFail($id);

        return view('admin.test.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'general' => 'required',
            'image1' => 'image',
            'image2' => 'image',
        ]);

        $question = TestQuestion::findOrFail($id);
        $question->update($request->only('general', 'locale'));

        if($request->has('answers_text1')) {
            $question->answers
                ->skip(0)->first()
                ->update([
                    'text' => $request->input('answers_text1')
                ]);
        }

        if($request->has('answers_text2')) {
            $question->answers
                ->skip(1)->first()
                ->update([
                   'text' => $request->input('answers_text2')
                ]);
        }

        if($request->hasFile('image1')) {
            $this->saveAnswerImage(
                $request->file('image1'),
                $question->answers->skip(0)->first()
            );
        }

        if($request->hasFile('image2')) {
            $this->saveAnswerImage(
                $request->file('image2'),
                $question->answers->skip(1)->first()
            );
        }

        return redirect(route('admin.tests.questions.index'))->with('message', 'Вопрос #'.$id.' обновлен!');
    }

    public function saveAnswerImage($image, $answer)
    {
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('i/test/answers'), $imageName);

        $answer->update([
                'image' => $imageName
            ]);
    }
}
