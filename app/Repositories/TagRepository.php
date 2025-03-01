<?php

namespace App\Repositories;

use App\Contracts\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface{

    public function getAllTags()
    {
        return auth()->user()->tags;
    }

    public function findTagById($id)
    {
        return auth()->user()->tags()->findOrFail($id);
    }

    public function createTag(array $data)
    {
        $tag = auth()->user()->tags()->create($data);
        return $tag;
    }

    public function updateTag($id, array $data)
    {
        $tag = $this->findTagById($id);
        $tag->update($data);
        return $tag;
    }

    public function deleteTag($id)
    {
        $tag = $this->findTagById($id);
        return $tag->delete();
    }
}