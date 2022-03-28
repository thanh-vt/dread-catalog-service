<?php


namespace App\Repositories\Impl;


use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryRepositoryImpl implements CategoryRepository
{

    private const CATEGORIES_TREE_QUERY = '
        WITH RECURSIVE categories_tree AS (
        SELECT ARRAY [id] AS hierarchy,
               0 AS level,
               *
        FROM categories
        WHERE parent_id IS NULL
        UNION ALL
        SELECT r.hierarchy || e.id,
               r.level + 1,
               e.*
        FROM categories e
                 INNER JOIN categories_tree r ON r.id = e.parent_id
        )
        SELECT *
        FROM categories_tree
        ORDER BY hierarchy
        ';

    public function all(): Collection|array
    {
        return Category::all();
    }

    public function tree(): Collection|array
    {
        $query = DB::raw(CategoryRepositoryImpl::CATEGORIES_TREE_QUERY);
        return Category::fromQuery($query, []);
    }

    public function show(int $id): Category
    {
        /** @var Category $category */
//        $subCategories = Category::find($id)->getSubCategories;
//        $category->subCategories = array();
//        foreach ($subCategories as $subCategory) {
//            array_push($category->subCategories, $subCategory);
//        }
        return Category::findOrFail($id);
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
