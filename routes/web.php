<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\StorageLocationController;
use App\Http\Controllers\ProductsCatalogController;
use App\Http\Controllers\ProjectsController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Наши разделы
    Route::resource('storage', StorageController::class);
    Route::resource('types', TypeProductController::class);
    Route::resource('locations', StorageLocationController::class);
    Route::resource('products', ProductsCatalogController::class);
    Route::resource('projects', ProjectsController::class);

    Route::resource('projects', ProjectsController::class);
    Route::post('projects/{project}/add-item', [ProjectsController::class, 'addItem'])->name('projects.addItem');
    Route::delete('projects/{project}/remove-item/{item}', [ProjectsController::class, 'removeItem'])->name('projects.removeItem');
});

require __DIR__.'/auth.php';