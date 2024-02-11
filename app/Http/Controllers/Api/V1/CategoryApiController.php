<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryApiController extends Controller
{
    /**
     * Get a list of all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        try {
            $categories = Category::all(); // Fetch all categories

            return APIHelper::makeAPIResponse($categories, 'Categories retrieved successfully');
        } catch (\Exception $e) {
            return APIHelper::makeAPIResponse(null, 'Failed to retrieve categories: ' . $e->getMessage(), 500, false);
        }
    }
}
