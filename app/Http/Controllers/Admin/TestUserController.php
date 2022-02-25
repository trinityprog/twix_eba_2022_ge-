<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TestUserExport;
use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\TestUserFilter;
use App\Models\TestUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestUserController extends Controller
{
    public function index(Request $request)
    {
        $test_users = TestUser::with(['user', 'result', 'result.answers', 'prize'])
            ->filter($request->all(), TestUserFilter::class)
            ->latest()
            ->paginate(25)
            ->appends($request->all());


        return view('admin.test_users.index', compact('test_users'));
    }

    public function export(Request $request)
    {
        $test_users = TestUser::with(['user', 'result', 'result.answers', 'prize'])
            ->filter($request->all(), TestUserFilter::class)
            ->latest()
            ->get();

        return Excel::download(new TestUserExport($test_users), 'test_usersExport-from-'.now().'.xlsx');
    }
}
