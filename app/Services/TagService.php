<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TagService
{
    /**
     * Fetch a tag by ID.
     *
     * @param int $tagId
     * @return Tag
     */
    public function getTagById(int $tagId): Tag
    {
        return Tag::findOrFail($tagId);
    }

    /**
     * Fetch all tags.
     *
     * @return Collection|Tag[]
     */
    public function getAllTags(): Collection
    {
        return Tag::all();
    }

    /**
     * Create a new tag.
     *
     * @param array $data
     * @return Tag
     * @throws InvalidArgumentException
     */
    public function createTag(array $data): Tag
    {
        // Validate the incoming data
        $data['slug'] = strtolower(str_replace(' ', '-', $data['name']));

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        // Create and return the new tag
        $tag = Tag::create($validator->validated());
        return $tag;
    }

    /**
     * Update an existing tag.
     *
     * @param int $tag
     * @param array $data
     * @return Tag
     * @throws ModelNotFoundException
     */
    public function updateTag(int $tag, array $data): Tag
    {
        $tag = Tag::findOrFail($tag);

        // validate
        $data['slug'] = strtolower(str_replace(' ', '-', $data['name']));
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:categories,name,' . $tag->id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $tag->id,
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $tag->update($validator->validated());

        return $tag;
    }

    /**
     * Delete a tag.
     *
     * @param Tag $tag
     * @return bool|null
     */
    public function deleteTag(int $tag): ?bool
    {
        return $tag->delete();
    }
}
