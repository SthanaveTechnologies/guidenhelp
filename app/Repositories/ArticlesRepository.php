<?php

namespace App\Repositories;

use App\Models\Article;

class ArticlesRepository
{
    public function getAll()
    {
        return Article::with(['category' => function ($query) {
            $query->select('id', 'title as category_name');
        }])->get();
    }

    public function create(array $data)
    {

        $article = Article::create([
            'title' => $data['title'],
            'category_id' => $data['category'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],

        ]);

        return $article;
    }

    public function find($id)
    {
        return Article::findOrFail($id); // Throw 404 if not found
    }
}
