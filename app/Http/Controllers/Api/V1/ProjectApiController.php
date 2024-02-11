<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category; // Ensure Category model is imported
use App\Models\Tag; // Import Tag model if tags are also needed
use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectApiController extends Controller
{
    /**
     * Get a list of projects with pagination, limit, and additional dropdown data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjectsList(Request $request, $page, $limit)
    {
        try {


            $limit = ($limit == -1) ? Project::count() : $limit;
            $skip = ((int)$page - 1) * (int)$limit;

            // Get projects with categories and tags, apply limit and pagination
            $projects = Project::with(['category', 'tags'])
                ->skip($skip)
                ->take($limit)
                ->get();

            // Optionally, add total count for pagination on the frontend
            $totalProjects = Project::count();

            // Prepare the response data
            $responseData = [
                'projects' => $projects,
                'total' => $totalProjects,
                'page' => (int) $page,
                'limit' => (int) $limit,
            ];

            return APIHelper::makeAPIResponse($responseData, 'Projects data retrieved successfully.');
        } catch (\Exception $e) {
            return APIHelper::makeAPIResponse(null, $e->getMessage(), 500, false);
        }
    }

    /**
     * Get a specific project by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $project = Project::with(['category', 'tags'])->find($id); // Fetch the project with category and tags from the database

            if (!$project) {
                return APIHelper::makeAPIResponse(null, 'Project not found.', 404, false);
            }

            return APIHelper::makeAPIResponse($project, 'Project retrieved successfully.');
        } catch (\Exception $e) {
            return APIHelper::makeAPIResponse(null, $e->getMessage(), 500, false);
        }
    }
}
