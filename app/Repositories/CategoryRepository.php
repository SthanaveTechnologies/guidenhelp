<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function getAll()
    {
        return Category::select(
            'categories.id',
            'categories.title as category_title',
            'categories.description',
            'categories.parent_id',
            'parent.title as parent_title',
            'categories.active',
            'categories.created_by',
            DB::raw("DATE_FORMAT(categories.created_at, '%Y-%m-%d %H:%i:%s') as created_at")
        )
            ->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
            ->get();
    }

    public function Categories()
    {
        return Category::select(
            'id',
            'title',
            'description',
            'parent_id',
            'active',
            'created_by',
            DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as created_at") // Format created_at directly
        )
            ->whereNull('parent_id')
            ->get();
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {

        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->findById($id);
        $category->update($data);

        return $category;
    }

    public function delete($id)
    {
        $category = $this->findById($id);
        $category->active = ! $category->active;
        $category->save();

        return $category;
    }

    // api side
    public function getCategoriAndSubCat()
    {

        $categories = Category::whereNull('parent_id')->with('subcategories')->get();

        \Log::info('Retrieved categories:', $categories->toArray());

        $formattedCategories = $categories->map(function ($category) {
            \Log::info('Category:', ['id' => $category->id, 'name' => $category->name]);

            return [
                'cat_id' => $category->id,
                'title' => $category->title,
                'subcategories' => $category->subcategories->map(function ($subcategory) {
                    return [
                        'sub_id' => $subcategory->id,
                        'title' => $subcategory->title,
                    ];
                }),
            ];
        });

        return $formattedCategories;
    }
}
