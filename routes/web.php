<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/categories', function () {
    return view('categories');
});
Route::get('/articles', function () {
    return view('articles');
});

Route::get('/article', function () {
    return view('article');
});

// categories route
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::post('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// articles route
Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::post('/article', [ArticlesController::class, 'store'])->name('articles.store');
Route::get('/article', [ArticlesController::class, 'getCat'])->name('article');
Route::get('/article/{id}', [ArticlesController::class, 'edit'])->name('article.edit');
