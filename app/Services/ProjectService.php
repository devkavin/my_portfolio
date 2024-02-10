<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    /**
     * Create a new project with the given data.
     *
     * @param array $data
     * @return Project
     * @throws InvalidArgumentException
     */
    public function createProject(array $data): Project
    {
        // Validate the incoming data
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            // Add any other fields as necessary
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        // Additional business logic could go here
        // For example, checking if a project with the same title already exists

        // Create and return the new project
        $project = Project::create($validator->validated());
        return $project;
    }

    /**
     * Update an existing project.
     *
     * @param int $projectId
     * @param array $data
     * @return Project
     * @throws ModelNotFoundException
     */
    public function updateProject(int $projectId, array $data): Project
    {
        $project = Project::findOrFail($projectId);

        $project->update($data);

        return $project;
    }

    /**
     * Delete a project by ID.
     *
     * @param int $projectId
     * @return bool|null
     * @throws ModelNotFoundException
     */
    public function deleteProject(int $projectId): ?bool
    {
        $project = Project::findOrFail($projectId);

        return $project->delete();
    }

    // You might add more methods here for other project-related operations,
    // such as fetching projects by category, user, or other criteria.

    // getProjectById

    /**
     * Fetch a project by its ID.
     *
     * @param int $projectId
     * @return Project
     * @throws ModelNotFoundException
     */
    public function getProjectById(int $projectId): Project
    {
        $project = Project::findOrFail($projectId);

        return $project;
    }

    /**
     * Fetch all projects.
     *
     * @return Collection|Project[]
     */
    public function getAllProjects(): Collection
    {
        $projects = Project::all();

        return $projects;
    }
}
