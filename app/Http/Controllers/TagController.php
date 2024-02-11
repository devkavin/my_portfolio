<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TagService;
use App\Helpers\APIHelper;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    protected $tagService;

    public function __construct()
    {
        $this->tagService = new TagService();
    }
    /**
     * Display a listing of tags.
     *
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $tag = $this->tagService->createTag($request->all());
            return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to create tag: ' . $e->getMessage());
            return redirect()->route('tags.index')->with('error', 'Failed to create tag.' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $tag = $this->tagService->getTagById($id);
        return view('tags.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $tag = $this->tagService->updateTag($id, $request->all());
            return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to update tag: ' . $e->getMessage());
            return redirect()->route('tags.index')->with('error', 'Failed to update tag.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $tag = $this->tagService->deleteTag($id);
            return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
        } catch (\Exception $e) {
            APIHelper::writeLog('Failed to delete tag: ' . $e->getMessage());
            return redirect()->route('tags.index')->with('error', 'Failed to delete tag.' . $e->getMessage());
        }
    }
}
