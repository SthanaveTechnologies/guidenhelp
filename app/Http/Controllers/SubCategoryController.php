<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\SubCategoryService;
use App\Services\CategoryService;


class SubCategoryController extends Controller
{
    protected $subCategoryService;
    protected $categoryService; // Inject CategoryService

    public function __construct(SubCategoryService $subCategoryService ,CategoryService $categoryService)
    {
        $this->subCategoryService = $subCategoryService;
        $this->categoryService = $categoryService; // Assign to the property
    }
    
    
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
            if (request()->ajax()) {
                $subCategories = $this->subCategoryService->getAllSubCategories();

            return DataTables::of($subCategories)
                ->addColumn('status', function ($subCategory) {
                    return $subCategory->active ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($subCategory) {
                    $editButton = '<a href="javascript:void(0)" class="text-secondary badge bg-gradient-primary text-white font-weight-bold text-xs edit-subCategory" data-id="' . $subCategory->id . '"  data-bs-toggle="modal"
                            data-bs-target="#modalSubCat">Edit</a>';
                    $toggleStatusButton = '<a href="javascript:void(0)" class="text-secondary badge bg-gradient-danger text-white font-weight-bold text-xs delete-subCategory" data-id="' . $subCategory->id . '">' . ($subCategory->active ? 'Deactivate' : 'Activate') . '</a>';
                    return $editButton . ' ' . $toggleStatusButton;
                })
                ->rawColumns(['actions'])
                ->make(true);
            }

        return view('subCategory',compact('categories'));
    }

    

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->subCategoryService->createCategory($request->all());

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = $this->subCategoryService->getCategoryById($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->subCategoryService->updateCategory($id, $request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $deleted = $this->subCategoryService->deleteCategory($id);
        // Check if the deletion was successful
    if ($deleted) {
        return response()->json([
            'success' => true,
            'message' => 'Category status updated successfully.',
            'active' => false,
        ]);
    } else {
       
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete the category.',
        ], 400); 
    }
    }
}
