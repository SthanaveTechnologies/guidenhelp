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

// Route::resource('categories', CategoryController::class);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


