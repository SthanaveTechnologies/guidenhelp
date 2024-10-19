<?php

namespace App\Services;

use App\Repositories\ArticlesRepository;

class ArticleService
{
    protected $articlesRepository;

    public function __construct(ArticlesRepository $articlesRepository)
    {
        $this->articlesRepository = $articlesRepository;
    }

    public function getAllArticles()
    {
        return $this->articlesRepository->getAll();
    }

    public function Categories()
    {
        return $this->articlesRepository->Categories();
    }

    public function findArticleById($id)
    {
        return $this->articlesRepository->find($id);
    }

    public function storeArticle(array $data)
    {
        return $this->articlesRepository->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->articlesRepository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->articlesRepository->delete($id);
    }
}
