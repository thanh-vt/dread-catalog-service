<?php


namespace App\Repositories\Impl;


use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class CategoryRepositoryImpl implements CategoryRepository
{

    public function all(): Collection|array
    {
        return Category::all();
    }

    public function show(int $id): Category
    {
        /** @var Category $category */
        $category = Category::findOrFail($id);
        $subCategories = $category->getSubCategories();
        $category->subCategories = array();
        foreach ($subCategories as $subCategory) {
            array_push($category->subCategories, $subCategory);
        }
        return $category;
    }

    /**
     * @throws Throwable
     */
    public function create(Category $category): Category
    {
        $category->saveOrFail();
        return $category;
    }

    /**
     * @throws Throwable
     */
    public function update(int $id, Category $category): Category
    {
        $category->updateOrFail();
        return $category;
    }

    /**
     * @throws Throwable
     */
    public function delete(Category $category)
    {
        $category->deleteOrFail();
    }
}
