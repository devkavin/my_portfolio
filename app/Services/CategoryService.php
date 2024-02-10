<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CategoryService
{
    /**
     * Create a new category with the given data.
     *
     * @param array $data
     * @return Category
     * @throws InvalidArgumentException
     */
    public function createCategory(array $data): Category
    {
        // Validate the incoming data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        // Create and return the new category
        $category = Category::create($validator->validated());
        return $category;
    }

    /**
     * Update an existing category.
     *
     * @param int $categoryId
     * @param array $data
     * @return Category
     * @throws ModelNotFoundException
     */
    public function updateCategory(int $categoryId, array $data): Category
    {
        $category = Category::findOrFail($categoryId);

        $category->update($data);

        return $category;
    }

    /**
     * Fetch a category by ID.
     *
     * @param int $categoryId
     * @return Category
     * @throws ModelNotFoundException
     */
    public function getCategoryById(int $categoryId): Category
    {
        return Category::findOrFail($categoryId);
    }

    /**
     * Fetch all categories.
     *
     * @return Collection|Category[]
     */
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    /**
     * Delete a category by ID.
     *
     * @param int $categoryId
     * @return bool|null
     * @throws ModelNotFoundException
     */
    public function deleteCategory(int $categoryId): ?bool
    {
        $category = Category::findOrFail($categoryId);

        // Additional checks can be performed here,
        // such as preventing deletion if the category contains projects.

        return $category->delete();
    }

    // Additional methods can be added to handle more complex business logic,
    // such as fetching categories with their related projects, etc.
}
