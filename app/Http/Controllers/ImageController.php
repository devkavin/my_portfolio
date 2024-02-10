<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Helpers\APIHelper;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Upload a new image and associate it with a project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JSONResponse
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048', // 2MB Max
            'project_id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            return APIHelper::makeAPIResponse(null, $validator->errors()->first(), 422, false);
        }

        try {
            $image = $this->imageService->uploadImage($request->file('image'), $request->input('project_id'));
            return APIHelper::makeAPIResponse($image, 'Image uploaded successfully.', 201);
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to upload image: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to upload image.', 500, false);
        }
    }

    /**
     * Delete the specified image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function destroy($id)
    {
        try {
            $this->imageService->deleteImage($id);
            return APIHelper::makeAPIResponse(null, 'Image deleted successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to delete image: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to delete image.', 500, false);
        }
    }

    // Additional methods for updating or listing images could be added here,
    // following the same structure for handling and responding to requests.
}
