<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\ProductsCatalog;
use App\Models\StorageLocation;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        // Загружаем записи склада вместе с данными о комплектующем и локации
        $storages = Storage::with(['product', 'location'])->paginate(10);
        return view('storage.index', compact('storages'));
    }

    public function create()
    {
        $products = ProductsCatalog::orderBy('pcName')->get();
        $locations = StorageLocation::orderBy('lsName')->get();
        return view('storage.create', compact('products', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'IDpc'   => 'required|exists:products_catalog,IDpc',
            'sCount' => 'required|integer|min:0',
            'lsName' => 'required|exists:storage_location,lsName',
        ]);

        Storage::create($validated);
        return redirect()->route('storage.index')->with('success', 'Запись добавлена на склад!');
    }

    public function edit($id)
    {
        $storage = Storage::findOrFail($id);
        $products = ProductsCatalog::orderBy('pcName')->get();
        $locations = StorageLocation::orderBy('lsName')->get();
        return view('storage.edit', compact('storage', 'products', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $storage = Storage::findOrFail($id);
        $validated = $request->validate([
            'IDpc'   => 'required|exists:products_catalog,IDpc',
            'sCount' => 'required|integer|min:0',
            'lsName' => 'required|exists:storage_location,lsName',
        ]);

        $storage->update($validated);
        return redirect()->route('storage.index')->with('success', 'Запись обновлена!');
    }

    public function destroy($id)
    {
        Storage::findOrFail($id)->delete();
        return redirect()->route('storage.index')->with('success', 'Запись удалена!');
    }
}
