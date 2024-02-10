<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ImageService
{
    /**
     * Upload an image and associate it with a project.
     *
     * @param UploadedFile $image
     * @param int $projectId
     * @return Image
     * @throws ModelNotFoundException
     */
    public function uploadImage(UploadedFile $image, int $projectId): Image
    {
        // Ensure the project exists
        $project = Project::findOrFail($projectId);

        // Define the path where the image will be stored
        $path = $image->store('public/projects');

        // Create and return the new Image record
        return Image::create([
            'project_id' => $project->id,
            'url' => Storage::url($path),
            // Add any additional fields as necessary, such as 'caption'
        ]);
    }

    /**
     * Delete an image by its ID.
     *
     * @param int $imageId
     * @return bool|null
     * @throws ModelNotFoundException
     */
    public function deleteImage(int $imageId): ?bool
    {
        $image = Image::findOrFail($imageId);

        // Delete the image file from storage
        Storage::delete($image->url);

        // Delete the image record from the database
        return $image->delete();
    }

    /**
     * Updates the information of an existing image.
     *
     * @param int $imageId
     * @param array $data
     * @return Image
     * @throws ModelNotFoundException
     */
    public function updateImage(int $imageId, array $data): Image
    {
        $image = Image::findOrFail($imageId);

        // Check if there's a new image to upload and replace the old one
        if (isset($data['newImage']) && $data['newImage'] instanceof UploadedFile) {
            // Delete the old image file
            Storage::delete($image->url);

            // Upload the new image
            $path = $data['newImage']->store('public/projects');
            $data['url'] = Storage::url($path);
        }

        // Update image record with new data
        $image->update($data);

        return $image;
    }

    // Additional methods can be implemented here for other image-related operations,
    // such as resizing images, fetching images for a project, etc.
}
