<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArticlesController extends Controller
{
    protected $articleService;

    protected $categoryService;

    public function __construct(ArticleService $articleService, CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {

        if (request()->ajax()) {
            $articles = $this->articleService->getAllArticles();

            return DataTables::of($articles)
                ->addColumn('category_name', function ($article) {
                    // Ensure that the category relationship exists and fetch the category name
                    return $article->category ? $article->category->category_name : 'N/A';
                })
                ->addColumn('status', function ($article) {
                    return '<span class="badge badge-sm '.($article->active ? 'bg-gradient-success' : 'bg-gradient-secondary').'">'.($article->active ? 'Active' : 'Inactive').'</span>';
                })
                ->addColumn('actions', function ($article) {
                    $editButton = '<a href="/article/'.$article->id.'" class="text-secondary badge bg-gradient-primary text-white font-weight-bold text-xs edit-article" data-id="'.$article->id.'" data-parentId="'.$article->cat_id.'">Edit</a>';
                    $toggleStatusButton = '<a href="javascript:void(0)" class="text-secondary badge bg-gradient-danger text-white font-weight-bold text-xs delete-category" data-id="'.$article->id.'">'.($article->active ? 'Deactivate' : 'Activate').'</a>';

                    return $editButton.' '.$toggleStatusButton;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('articles');
    }

    public function getCat()
    {
        $CatList = $this->categoryService->getAllCategories();

        return view('article', compact('CatList'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
        ]);
        $article = $this->articleService->storeArticle($request->all());

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $article = $this->articleService->findArticleById($id); // Fetch the article
        $CatList = $this->categoryService->getAllCategories(); // Fetch all categories if needed for a dropdown

        return view('article', compact('article', 'CatList'));
    }
}
