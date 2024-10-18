<?php 

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;


class SubCategoryRepository
{
    public function getAll()
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
        ->where('active', 1)
        ->whereNotNull('parent_id')
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
            $category->active = !$category->active; 
            $category->save();
    
            return $category;
    }
}
