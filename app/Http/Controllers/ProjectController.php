<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of projects.
     *
     * @return \Illuminate\Http\JSONResponse
     */
    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        return APIHelper::makeAPIResponse($projects, 'Projects retrieved successfully.');
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JSONResponse
     */
    public function store(Request $request)
    {
        try {
            $project = $this->projectService->createProject($request->all());
            return APIHelper::makeAPIResponse($project, 'Project created successfully.', 201);
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to create project: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to create project.', 500, false);
        }
    }

    /**
     * Display the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function show($id)
    {
        try {
            $project = $this->projectService->getProjectById($id);
            return APIHelper::makeAPIResponse($project, 'Project retrieved successfully.');
        } catch (ModelNotFoundException $e) {
            APIHelper::writeLog('Project not found: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Project not found.', 404, false);
        }
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $project = $this->projectService->updateProject($id, $request->all());
            return APIHelper::makeAPIResponse($project, 'Project updated successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to update project: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to update project.', 500, false);
        }
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function destroy($id)
    {
        try {
            $this->projectService->deleteProject($id);
            return APIHelper::makeAPIResponse(null, 'Project deleted successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to delete project: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to delete project.', 500, false);
        }
    }
}
