<?php


namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface CategoryService
{
    public function all(): AnonymousResourceCollection;

    public function tree(): AnonymousResourceCollection;

    public function show(int $id): CategoryResource;

    public function create(StoreCategoryRequest $storeCategoryRequest): CategoryResource;

    public function update(int $id, UpdateCategoryRequest $updateCategoryRequest): CategoryResource;

    public function delete(int $id);
}
