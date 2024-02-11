<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Helpers\APIHelper;

class TagApiController extends Controller
{
    /**
     * Get a list of all tags.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTags()
    {
        try {
            $tags = Tag::all(); // Fetch all tags

            return APIHelper::makeAPIResponse($tags, 'Tags retrieved successfully');
        } catch (\Exception $e) {
            return APIHelper::makeAPIResponse(null, 'Failed to retrieve tags: ' . $e->getMessage(), 500, false);
        }
    }
}
