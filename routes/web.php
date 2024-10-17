<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/categories', function () {
    return view('categories');
});

Route::get('/billing', function () {
    return view('billing');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::post('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


