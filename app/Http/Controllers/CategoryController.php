<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\JSONResponse
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return APIHelper::makeAPIResponse($categories, 'Categories retrieved successfully.');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JSONResponse
     */
    public function store(Request $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->all());
            return APIHelper::makeAPIResponse($category, 'Category created successfully.', 201);
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to create category: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to create category.', 500, false);
        }
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function show($id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            return APIHelper::makeAPIResponse($category, 'Category retrieved successfully.');
        } catch (ModelNotFoundException $e) {
            APIHelper::writeLog('Category not found: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Category not found.', 404, false);
        }
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->all());
            return APIHelper::makeAPIResponse($category, 'Category updated successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to update category: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to update category.', 500, false);
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return APIHelper::makeAPIResponse(null, 'Category deleted successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to delete category: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to delete category.', 500, false);
        }
    }
}
