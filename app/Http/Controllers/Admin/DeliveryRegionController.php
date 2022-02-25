<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryRegion;
use Illuminate\Http\Request;

class DeliveryRegionController extends Controller
{
    public function index()
    {
        $delivery_regions = DeliveryRegion::all();

        return view('admin.delivery_regions.index', compact('delivery_regions'));
    }

    public function create()
    {
        return view('admin.delivery_regions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'general' => 'required',
            'locale' => 'string'
        ]);

        DeliveryRegion::create($data);

        return redirect()->route('admin.delivery_regions.index')->with('message', 'Область создана!');
    }

    public function edit($id)
    {
        $delivery_region = DeliveryRegion::findOrFail($id);

        return view('admin.delivery_regions.edit', compact('delivery_region'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'general' => 'required',
            'locale' => 'string'
        ]);

        $delivery_region = DeliveryRegion::findOrFail($id);
        $delivery_region->update($data);

        return redirect()->route('admin.delivery_regions.index')->with('message', 'Область #'.$id.' обновлена!');
    }

    public function destroy($id)
    {
        DeliveryRegion::destroy($id);

        return redirect()->route('admin.delivery_regions.index')->with('message', 'Область #'.$id.' удалена!');
    }
}
