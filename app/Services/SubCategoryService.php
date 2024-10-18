<?php
namespace App\Services;

use App\Repositories\SubCategoryRepository;

class SubCategoryService
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getAllSubCategories()
    {
        return $this->subCategoryRepository->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->subCategoryRepository->findById($id);
    }

    public function createCategory(array $data)
    {
        return $this->subCategoryRepository->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->subCategoryRepository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->subCategoryRepository->delete($id);
    }
}
