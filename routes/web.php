<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/categories', function () {
    return view('categories');
});

Route::get('/subCategory', function () {
    return view('subCategory');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::post('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/subCategories', [SubCategoryController::class, 'index'])->name('subCategory.index');
Route::post('/subCategories', [SubCategoryController::class, 'store'])->name('subCategory.store');
Route::get('/subCategories/{id}', [SubCategoryController::class, 'edit'])->name('subCategory.edit');
Route::post('/subCategories/{id}', [SubCategoryController::class, 'update'])->name('subCategory.update');
Route::post('/subCategories/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subCategory.destroy');

// Route::post('/textEditor', [CategoryController::class, 'storeEditor'])->name('storeEditor');


