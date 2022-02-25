<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\WinnerFilter;
use App\Models\Prize;
use App\Models\User;
use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class WinnerController extends Controller
{
    public function index(Request $request)
    {
        $winners = Winner::with(['user', 'prize'])
            ->filter($request->all(), WinnerFilter::class)
            ->latest('won_at')
            ->paginate(25)
            ->appends($request->all());

        return view('admin.winners.index', compact('winners'));
    }

    public function create()
    {
        $prizes = Prize::where('type', 'weekly')->get();
        return view('admin.winners.create', compact('prizes'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['phone'] = blink()->clear($request->input('phone'));
        $data['won_at'] = Carbon::parse($request->input('won_at'));

        $validator = Validator::make($data, [
            'phone' => 'required|exists:users,phone',
            'prize' => 'required',
            'won_at' => 'required'
        ]);

        if($validator->fails()) return back()->withInput($request->all())->withErrors($validator->errors());

        $data['user_id'] = User::where('phone', $data['phone'])->firstOrFail('id')->id;
        $winner = Winner::create([
            'user_id' => $data['user_id'],
            'prize_id' => $data['prize'],
            'won_at' => $data['won_at'],
        ]);

        return redirect()->route('admin.winners.index')->with('message', 'Победитель создан!');
    }

    public function edit($id)
    {
        $winner = Winner::findOrFail($id);
        $prizes = Prize::where('type', 'weekly')->get();

        return view('admin.winners.edit', compact('winner', 'prizes'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['phone'] = blink()->clear($request->input('phone'));
        $data['won_at'] = Carbon::parse($request->input('won_at'));

        $validator = Validator::make($data, [
            'phone' => 'required|exists:users,phone',
            'prize' => 'required',
            'won_at' => 'required'
        ]);

        if($validator->fails()) return back()->withInput($request->all())->withErrors($validator->errors());

        $data['user_id'] = User::where('phone', $data['phone'])->firstOrFail('id')->id;
        $winner = Winner::findOrFail($id);
        $winner->update([
            'user_id' => $data['user_id'],
            'prize_id' => $data['prize'],
            'won_at' => $data['won_at'],
        ]);

        return redirect()->route('admin.winners.index')->with('message', 'Победитель #'.$id.' обновлен!');
    }

    public function destroy($id)
    {
        Winner::destroy($id);

        return redirect()->route('admin.winners.index')->with('message', 'Победитель #'.$id.' удален!');
    }
}
