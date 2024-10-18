<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SubCategoryService;
use Illuminate\Http\JsonResponse;

class SubCategoryController extends Controller
{
    protected $SubCategoryService;

    public function __construct(SubCategoryService $SubCategoryService)
    {
        $this->SubCategoryService = $SubCategoryService;
    }

    public function getSubCategories(): JsonResponse
    {
       
        $categories = $this->SubCategoryService->getAllSubCategories();
        return response()->json($categories);
    }
}
