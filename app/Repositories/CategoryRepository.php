<?php


namespace App\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepository
{
    public function all(): Collection|array;

    public function show(int $id): Category;

    public function create(Category $category): Category;

    public function update(int $id, Category $category): Category;

    public function delete(Category $category);

}
