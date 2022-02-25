<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ScannerExport;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ModelFilters\Admin\ScannerFilter;
use App\Models\Scanner;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ScannerController extends Controller
{
    public function index(Request $request)
    {
        $scanners = Scanner::with('user')
            ->filter($request->all(), ScannerFilter::class)
            ->latest()
            ->paginate(25)
            ->appends($request->all());


        return view('admin.scanners.index', compact('scanners'));
    }

    public function export(Request $request)
    {
        $scanners = Scanner::with('user')
            ->filter($request->all(), ScannerFilter::class)
            ->latest()
            ->get();

        return Excel::download(new ScannerExport($scanners), 'scannersExport-from-'.now().'.xlsx');
    }

    public function edit($id)
    {
        $scanner = Scanner::findOrFail($id);

        return view('admin.scanner.edit', compact('scanner'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'user_id' => 'required|numeric',
			'type' => 'required',
			'picture' => 'required',
			'status' => 'required|numeric'
		]);
        $requestData = $request->all();

        $scanner = Scanner::findOrFail($id);
        $scanner->update($requestData);

        return redirect('admin/scanner')->with('flash_message', 'Scanner updated!');
    }
}
