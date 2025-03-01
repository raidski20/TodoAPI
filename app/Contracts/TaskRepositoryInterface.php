<?php

namespace App\Contracts;

interface TaskRepositoryInterface {
    
    public function getAllTasks(?string $status = null, ?string $tag = null);

    public function findTaskById($id);

    public function createTask(array $data);

    public function updateTask($id, array $data);

    public function deleteTask($id);
}