<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private const RESOURCE_ROUTE_PARAM = 'category';

    private CategoryService $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return \response($this->categoryService->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return Response
     */
    public function store(StoreCategoryRequest $request): Response
    {
        return \response($this->categoryService->create($request));
    }

    /**
     * Display the specified resource.
     *
     * @param StoreCategoryRequest $request
     * @return Response
     */
    public function show(StoreCategoryRequest $request): Response
    {
        $id = $request->route(CategoryController::RESOURCE_ROUTE_PARAM);
        return \response($this->categoryService->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @return Response
     */
    public function update(UpdateCategoryRequest $request): Response
    {
        $id = $request->route(CategoryController::RESOURCE_ROUTE_PARAM);
        return \response($this->categoryService->update($id, $request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request): Response
    {
        $id = $request->route(CategoryController::RESOURCE_ROUTE_PARAM);
        $this->categoryService->delete($id);
        return \response();
    }
}
