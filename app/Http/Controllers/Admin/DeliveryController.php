<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelFilters\Admin\DeliveryFilter;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $deliveries = Delivery::with('user')
            ->filter($request->all(), DeliveryFilter::class)
            ->latest()
            ->paginate(25)
            ->appends($request->all());

        return view('admin.deliveries.index', compact('deliveries'));
    }
}
