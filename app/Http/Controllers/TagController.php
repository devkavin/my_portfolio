<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Helpers\APIHelper;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of tags.
     *
     * @return \Illuminate\Http\JSONResponse
     */
    public function index()
    {
        $tags = Tag::all();
        return APIHelper::makeAPIResponse($tags, 'Tags retrieved successfully.');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JSONResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:tags|max:255',
        ]);

        if ($validator->fails()) {
            return APIHelper::makeAPIResponse(null, $validator->errors()->first(), 400, false);
        }

        try {
            $tag = Tag::create($validator->validated());
            return APIHelper::makeAPIResponse($tag, 'Tag created successfully.', 201);
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to create tag: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to create tag.', 500, false);
        }
    }

    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return APIHelper::makeAPIResponse(null, 'Tag not found.', 404, false);
        }

        return APIHelper::makeAPIResponse($tag, 'Tag retrieved successfully.');
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:tags,name,' . $id . '|max:255',
        ]);

        if ($validator->fails()) {
            return APIHelper::makeAPIResponse(null, $validator->errors()->first(), 400, false);
        }

        try {
            $tag = Tag::findOrFail($id);
            $tag->update($validator->validated());
            return APIHelper::makeAPIResponse($tag, 'Tag updated successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to update tag: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to update tag.', 500, false);
        }
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JSONResponse
     */
    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return APIHelper::makeAPIResponse(null, 'Tag deleted successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to delete tag: ' . $e->getMessage());
            return APIHelper::makeAPIResponse(null, 'Failed to delete tag.', 500, false);
        }
    }
}
