<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount(['checks', 'scanners', 'tests'])
            ->filter($request->all(), UserFilter::class)
            ->latest()
            ->paginate(25)
            ->appends($request->all());


        return view('admin.users.index', compact('users'));
    }

    public function export(Request $request)
    {
        $users = User::withCount(['checks', 'scanners', 'tests'])
            ->filter($request->all(), UserFilter::class)
            ->latest()
            ->get();

        return Excel::download(new UserExport($users), 'usersExport-from-'.now().'.xlsx');
    }
}
