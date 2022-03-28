<?php


namespace App\Services\Impl;


use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryServiceImpl implements CategoryService
{

    private CategoryRepository $categoryRepository;

    /**
     * CategoryServiceImpl constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->categoryRepository->all());
    }

    public function tree(): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->categoryRepository->tree());
    }

    public function show(int $id): CategoryResource
    {
        $existedCategory = $this->categoryRepository->show($id);
        return new CategoryResource($existedCategory);
    }

    public function create(StoreCategoryRequest $storeCategoryRequest): CategoryResource
    {
        $category = $storeCategoryRequest->toModel();
        $category = $this->categoryRepository->create($category);
        return new CategoryResource($category);
    }

    public function update(int $id, UpdateCategoryRequest $updateCategoryRequest): CategoryResource
    {
        $existedCategory = $this->categoryRepository->show($id);
        $category = $updateCategoryRequest->toModel($existedCategory);
        $category = $this->categoryRepository->update($id, $category);
        return new CategoryResource($category);
    }


    public function delete(int $id)
    {
        $existedCategory = $this->categoryRepository->show($id);
        $this->categoryRepository->delete($existedCategory);
    }
}
