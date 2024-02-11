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
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('categories.create');
    }


    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->all());
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to create category: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Failed to create category.' . $e->getMessage());
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
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->all());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to update category: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Failed to update category.' . $e->getMessage());
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
