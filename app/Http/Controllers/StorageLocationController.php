<?php

namespace App\Http\Controllers;

use App\Models\StorageLocation;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

class StorageLocationController extends Controller
{
    public function index()
    {
        $locations = StorageLocation::with('type')->paginate(10);
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        $types = TypeProduct::orderBy('tpName')->get();
        return view('locations.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lsName' => 'required|string|max:20|unique:storage_location,lsName',
            'IDtp' => 'required|exists:type_product,IDtp',
            'slAddres' => 'nullable|string|max:100|unique:storage_location,slAddres',
            'slPhone' => 'nullable|string|max:15|unique:storage_location,slPhone',
        ]);

        StorageLocation::create($validated);
        return redirect()->route('locations.index')->with('success', 'Локация добавлена!');
    }

    public function edit($lsName)
    {
        $location = StorageLocation::findOrFail($lsName);
        $types = TypeProduct::orderBy('tpName')->get();
        return view('locations.edit', compact('location', 'types'));
    }

    public function update(Request $request, $lsName)
    {
        $location = StorageLocation::findOrFail($lsName);
        $validated = $request->validate([
            'lsName' => 'required|string|max:20|unique:storage_location,lsName,'.$lsName.',lsName',
            'IDtp' => 'required|exists:type_product,IDtp',
            'slAddres' => 'nullable|string|max:100|unique:storage_location,slAddres,'.$lsName.',lsName',
            'slPhone' => 'nullable|string|max:15|unique:storage_location,slPhone,'.$lsName.',lsName',
        ]);

        $location->update($validated);
        return redirect()->route('locations.index')->with('success', 'Локация обновлена!');
    }

    public function destroy($lsName)
    {
        $location = StorageLocation::findOrFail($lsName);
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Локация удалена!');
    }
}
