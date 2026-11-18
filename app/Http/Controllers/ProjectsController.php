<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\ProjectItems;
use App\Models\ProductsCatalog;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::withCount('items')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Project_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'required|string',
            'start_date'   => 'nullable|date',
        ]);

        Projects::create($validated);
        return redirect()->route('projects.index')->with('success', 'Проект создан!');
    }

    public function show($id)
    {
        // Загружаем проект и его спецификацию (комплектующие)
        $project = Projects::with(['items.product'])->findOrFail($id);
        $products = ProductsCatalog::orderBy('pcName')->get(); // Для выпадающего списка
        
        return view('projects.show', compact('project', 'products'));
    }

    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);
        $validated = $request->validate([
            'Project_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'required|string',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date',
        ]);

        $project->update($validated);
        return redirect()->route('projects.show', $project->IDproject)->with('success', 'Проект обновлен!');
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        // Если удаляем проект, сначала нужно удалить его спецификацию, чтобы триггеры вернули товары на склад
        foreach ($project->items as $item) {
            $item->delete();
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Проект удален!');
    }

    // --- ДОБАВЛЕНИЕ КОМПЛЕКТУЮЩЕГО В ПРОЕКТ ---
    public function addItem(Request $request, $id)
    {
        $request->validate([
            'IDpc' => 'required|exists:products_catalog,IDpc',
            'piCount' => 'required|integer|min:1',
        ]);

        try {
            ProjectItems::create([
                'IDproject' => $id,
                'IDpc' => $request->IDpc,
                'piCount' => $request->piCount,
            ]);

            return redirect()->route('projects.show', $id)->with('success', 'Комплектующее добавлено. Склад обновлен.');

        } catch (QueryException $e) {
            // Перехватываем ошибку от триггера БД (SQLSTATE 45000)
            if ($e->getCode() == '45000') {
                // Вытаскиваем текст ошибки из сообщения БД
                $msg = explode(':', $e->getMessage())[1] ?? 'Недостаточно товара на складе.';
                return redirect()->route('projects.show', $id)->with('error', trim($msg));
            }
            return redirect()->route('projects.show', $id)->with('error', 'Ошибка базы данных при добавлении.');
        }
    }

    // --- УДАЛЕНИЕ КОМПЛЕКТУЮЩЕГО ИЗ ПРОЕКТА ---
    public function removeItem($projectId, $itemId)
    {
        $item = ProjectItems::where('IDproject', $projectId)->findOrFail($itemId);
        
        try {
            $item->delete(); // Триггер вернет товар на склад
            return redirect()->route('projects.show', $projectId)->with('success', 'Комплектующее удалено. Товар возвращен на склад.');
        } catch (QueryException $e) {
            return redirect()->route('projects.show', $projectId)->with('error', 'Ошибка при удалении из спецификации.');
        }
    }
}