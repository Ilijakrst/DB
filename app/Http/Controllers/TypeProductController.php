<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    public function index()
    {
        $types = TypeProduct::withCount('products')->paginate(10);
        return view('types.index', compact('types'));
    }

    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tpName' => 'required|string|max:100|unique:type_product,tpName',
        ], [
            'tpName.required' => 'Введите название категории',
            'tpName.unique' => 'Такая категория уже существует'
        ]);

        TypeProduct::create($validated);
        return redirect()->route('types.index')->with('success', 'Категория добавлена!');
    }

    public function edit($id)
    {
        $type = TypeProduct::findOrFail($id);
        return view('types.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $type = TypeProduct::findOrFail($id);
        $validated = $request->validate([
            'tpName' => 'required|string|max:100|unique:type_product,tpName,'.$id.',IDtp',
        ]);

        $type->update($validated);
        return redirect()->route('types.index')->with('success', 'Категория обновлена!');
    }

    public function destroy($id)
    {
        $type = TypeProduct::findOrFail($id);
        // Проверка: если есть товары этой категории, запрещаем удалять
        if ($type->products()->count() > 0) {
            return redirect()->route('types.index')->with('error', 'Нельзя удалить категорию, в которой есть комплектующие!');
        }
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Категория удалена!');
    }
}