<?php

namespace App\Http\Controllers;

use App\Models\ProductsCatalog;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

class ProductsCatalogController extends Controller
{
    public function index()
    {
        // Загружаем комплектующие вместе с их категориями
        $products = ProductsCatalog::with('type')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $types = TypeProduct::orderBy('tpName')->get();
        return view('products.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pcName' => 'required|string|max:100|unique:products_catalog,pcName',
            'IDtp' => 'required|exists:type_product,IDtp',
            'pcDescription' => 'nullable|string|max:255',
        ], [
            'pcName.required' => 'Введите название комплектующего',
            'pcName.unique' => 'Такое комплектующее уже есть в каталоге',
            'IDtp.required' => 'Выберите категорию',
        ]);

        ProductsCatalog::create($validated);
        return redirect()->route('products.index')->with('success', 'Комплектующее добавлено в каталог!');
    }

    public function show($id)
    {
        $product = ProductsCatalog::with(['type', 'storage'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = ProductsCatalog::findOrFail($id);
        $types = TypeProduct::orderBy('tpName')->get();
        return view('products.edit', compact('product', 'types'));
    }

    public function update(Request $request, $id)
    {
        $product = ProductsCatalog::findOrFail($id);
        $validated = $request->validate([
            'pcName' => 'required|string|max:100|unique:products_catalog,pcName,'.$id.',IDpc',
            'IDtp' => 'required|exists:type_product,IDtp',
            'pcDescription' => 'nullable|string|max:255',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Комплектующее обновлено!');
    }

    public function destroy($id)
    {
        $product = ProductsCatalog::findOrFail($id);
        
        // Проверка: если товар есть на складе, удалять нельзя (из-за связей)
        if ($product->storage) {
            return redirect()->route('products.index')->with('error', 'Нельзя удалить: товар есть на складе!');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Комплектующее удалено!');
    }
}
