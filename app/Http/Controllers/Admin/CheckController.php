<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CheckExport;
use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\CheckFilter;
use App\Models\Check;
use App\Services\BotNotificationService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class CheckController extends Controller
{
    public function index(Request $request)
    {
        session()->put('checks_filter', request()->fullUrl());

        $checks = Check::with('user')
            ->filter($request->all(), CheckFilter::class)
            ->latest()
            ->paginate(25)
            ->appends($request->all());


        return view('admin.checks.index', compact('checks'));
    }

    public function export(Request $request)
    {
        $checks = Check::with('user')
            ->filter($request->all(), CheckFilter::class)
            ->latest()
            ->get();

        return Excel::download(new CheckExport($checks), 'checksExport-from-'.now().'.xlsx');
    }

    public function edit($id)
    {
        $check = Check::findOrFail($id);

        return view('admin.checks.edit', compact('check'));
    }

    public function update(Request $request, $id, BotNotificationService $botNotificationService)
    {
        $this->validate($request, [
			'status' => 'required',
		]);

        $check = Check::findOrFail($id);
        $check->update($request->only('status', 'comment'));

        if($check->status == 1 && $check->type == 'confirm')
            $check->user->activatePrize($check->id);

        $botNotificationService->checkStatus([
            'phone' => $check->user->phone,
            'status' => $check->status,
            'status_text' =>$check->comment
        ]);

        return redirect(session()->has('checks_filter') ? session('checks_filter') : route('admin.checks.index'))->with('message', 'Чек #'.$id.' обновлен!');
    }

    public function rotate($id, $direction)
    {
        $check = Check::find($id);
        $img = Image::make(storage_path('app/public/checks/' . $check->photo));


        if($direction == 'right') {
            $img->rotate(-90);
        }
        if($direction == 'left') {
            $img->rotate(90);
        }
        $img->save();

        return redirect()->route('admin.checks.edit', ['check' => $id]);
    }
}
