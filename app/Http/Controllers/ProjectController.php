<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    protected $projectService, $categoryService, $tagService;

    public function __construct(ProjectService $projectService, CategoryService $categoryService, TagService $tagService)
    {
        $this->projectService = $projectService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of projects.
     *
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        // Use the services to fetch categories and tags
        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();

        // Return the create view with categories and tags data
        return view('projects.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $project = $this->projectService->createProject($request->all());
            $project->tags()->sync($request->tags);
            // redirect to the project index page with a success message
            return redirect()->route('projects.index')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to create project: ' . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Failed to create project.' . $e->getMessage());
        }
    }

    /**
     * Display the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        try {
            $project = $this->projectService->getProjectById($id);
            return view('projects.show', ['project' => $project]);
        } catch (ModelNotFoundException $e) {
            APIHelper::writeLog('Project not found: ' . $e->getMessage());
            return view('projects.show', ['error' => 'Project not found.' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        // Use the services to fetch categories and tags
        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();

        // Use the project service to fetch the project
        $project = $this->projectService->getProjectById($id);

        // Return the edit view with categories, tags, and project data
        return view('projects.edit', [
            'categories' => $categories,
            'tags' => $tags,
            'project' => $project,
        ]);
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $project = $this->projectService->updateProject($id, $request->all());
            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to update project: ' . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Failed to update project.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->projectService->deleteProject($id);
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to delete project: ' . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Failed to delete project.' . $e->getMessage());
        }
    }
}
