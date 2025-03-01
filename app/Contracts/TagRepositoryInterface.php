<?php

namespace App\Contracts;

interface TagRepositoryInterface {

    public function getAllTags();

    public function findTagById($id);

    public function createTag(array $data);

    public function updateTag($id, array $data);

    public function deleteTag($id);
}