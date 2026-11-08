<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPlaceController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;

//Route::get('/', function() {
//    return view('welcome');
//});

Route::get('/huy', [MyPlaceController::class, 'index']);

Route::get('/huy1', [StorageController::class, 'index']);

//Route::get('/create', [StorageController::class, 'create']);

// Route::get('/update', [StorageController::class, 'update']);

Route::get('/delete',[StorageController::class, 'delete']);

Route::get('/v', [StorageController::class, 'index'])->name('storage.index');

Route::get('/a', [AboutController::class, 'index'])->name('about.index');

Route::get('/c', [ContactController::class, 'index'])->name('contact.index');

Route::get('/d',[DashboardController::class, 'index']);

require __DIR__.'/auth.php';
