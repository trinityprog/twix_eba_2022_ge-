<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\PrizeFilter;
use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function index(Request $request)
    {
        $prizes = Prize::filter($request->all(), PrizeFilter::class)->get();

        return view('admin.prizes.index', compact('prizes'));
    }

    public function edit($id)
    {
        $prize = Prize::findOrFail($id);

        return view('admin.prizes.edit', compact('prize'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'general' => 'required',
            'locale' => 'string',
            'initial_amount' => 'integer',
        ]);

        $prize = Prize::findOrFail($id);
        $prize->update($data);

        return redirect()->route('admin.prizes.index')->with('message', 'Приз #'.$id.' обновлен!');
    }
}
