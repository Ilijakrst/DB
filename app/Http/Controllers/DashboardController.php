<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ProductsCatalog;
use App\Models\TypeProduct;
use App\Models\StorageLocation;
use App\Models\Projects;
use App\Models\Storage;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        // 1. Собираем базовую статистику
        $totalProducts = ProductsCatalog::count();
        $totalCategories = TypeProduct::count();
        $totalLocations = StorageLocation::count();
        
        // Считаем только активные проекты (не завершенные)
        $activeProjects = Projects::where('status', '!=', 'Завершен')->count();

        // 2. Ищем товары, которых на складе осталось мало (меньше 10 штук)
        $lowStock = Storage::with('product')
            ->where('sCount', '<', 10)
            ->orderBy('sCount', 'asc')
            ->take(5)
            ->get();

        // 3. Последние 4 проекта для быстрого доступа
        $recentProjects = Projects::orderBy('IDproject', 'desc')->take(4)->get();

        // 4. Данные для графика (сколько комплектующих в каждой категории)
        $chartData = TypeProduct::withCount('products')->get();
        $chartLabels = $chartData->pluck('tpName');
        $chartValues = $chartData->pluck('products_count');

        return view('dashboard', compact(
            'totalProducts', 
            'totalCategories', 
            'totalLocations', 
            'activeProjects',
            'lowStock',
            'recentProjects',
            'chartLabels',
            'chartValues'
        ));
    }
}