<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuleController extends Controller
{
    public function index()
    {
        $langs_rules = ['ru', 'kk'];

        return view('admin.rules.index', compact('langs_rules'));
    }

    public function edit($lang)
    {
        return view('admin.rules.edit', compact('lang'));
    }

    public function update(Request $request, $lang)
    {
        $inputName = 'rules_'.$lang;

        $request->validate([
            $inputName => 'required|file|mimes:pdf'
        ]);

        $fileName = $lang.'.pdf';
        $request->file($inputName)->move(public_path('rules/'), $fileName);

        return redirect()->route('admin.rules.index')->with('message', 'Правила '.$lang.' обновлены!');
    }
}
