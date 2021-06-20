<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use App\Services\Categories\CategoryIndexService;
use App\Services\Categories\CategoryStoreService;
use App\Services\Categories\CategoryUpdateService;

class CategoryController extends Controller
{
    protected $indexService, $storeService, $updateService;

    /**
     * CategoryController constructor.
     * @param CategoryIndexService $indexService
     */
    public function __construct(
        CategoryIndexService $indexService,
        CategoryStoreService $storeService,
        CategoryUpdateService $updateService
    )
    {
        $this->indexService = $indexService;
        $this->storeService = $storeService;
        $this->updateService = $updateService;
    }

    /**
     * Return a collection of categories
     */
    public function index()
    {
       $categories = CategoryResource::collection(
           $this->indexService->categories()
       );

       return $this->indexService->handle($categories, request()->wantsJson());
    }

    /**
     * Store a new category
     * @param CategoryStoreRequest $request
     * @return mixed
     */
    public function store(CategoryStoreRequest $request)
    {
        return new CategoryResource(
            $this->storeService->handle($request->validated())
        );
    }

    /**
     * Update a category
     * @param Category $category
     * @param CategoryUpdateRequest $request
     * @return mixed
     */
    public function update(Category $category, CategoryUpdateRequest $request)
    {
         $this->updateService->update($category, $request->validated());

         return response($category, 200);
    }

    /**
     * Delete a category
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->updateService->delete($category);

        return response([], 204);
    }
}
