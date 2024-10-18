<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
       
            if (request()->ajax()) {
                $categories = $this->categoryService->getAllCategories();

            return DataTables::of($categories)
                ->addColumn('status', function ($category) {
                    return '<span class="badge badge-sm ' . ($category->active ? 'bg-gradient-success' : 'bg-gradient-secondary') . '">' . ($category->active ? 'Active' : 'Inactive') . '</span>';
                })
            
                ->addColumn('actions', function ($category) {
                    $editButton = '<a href="javascript:void(0)" class="text-secondary badge bg-gradient-primary text-white font-weight-bold text-xs edit-category" data-id="' . $category->id . '" data-bs-toggle="modal"
                            data-bs-target="#modalCat">Edit</a>';
                    $toggleStatusButton = '<a href="javascript:void(0)" class="text-secondary badge bg-gradient-danger text-white font-weight-bold text-xs delete-category" data-id="' . $category->id . '">' . ($category->active ? 'Deactivate' : 'Activate') . '</a>';
                    return $editButton . ' ' . $toggleStatusButton;
                })
                ->rawColumns(['status','actions'])
                ->make(true);
            }

        return view('categories');
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

        $this->categoryService->createCategory($request->all());

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->categoryService->updateCategory($id, $request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $deleted = $this->categoryService->deleteCategory($id);
       
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


    public function storeEditor(Request $request)
    {
        $content = $request->input('content');
        dd($content);
        // Save the content to the database, or perform other actions
        // Example: YourModel::create(['content' => $content]);

        return back()->with('success', 'Content saved successfully!');
    }

}
