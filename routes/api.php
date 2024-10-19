<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;



Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/subCategories', [SubCategoryController::class, 'getSubCategories']);
