<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::oldest('order')->paginate(25);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'answer' => 'required',
            'question' => 'required',
            'locale' => 'required',
            'order' => 'required',
        ]);

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('message', 'Faq создан!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'answer' => 'required',
            'question' => 'required',
            'locale' => 'required',
            'order' => 'required',
        ]);

        $faq= Faq::findOrFail($id);
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('message', 'Faq #'.$id.' обновлен!');
    }

    public function destroy($id)
    {
        Faq::destroy($id);

        return redirect()->route('admin.faqs.index')->with('message', 'Faq #'.$id.' удален!');
    }
}
