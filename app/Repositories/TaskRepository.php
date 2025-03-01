<?php

namespace App\Repositories;

use App\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface{

    public function getAllTasks(?string $status = null, ?string $tag = null) 
    {
        return auth()->user()
            ->tasks()
            ->filterByStatus($status)
            ->FilterByTag($tag)
            ->get();
    }

    public function findTaskById($id)
    {
        return auth()->user()->tasks()->findOrFail($id);
    }

    public function createTask(array $data)
    {
        $task = auth()->user()->tasks()->create($data);
        return $task;
    }

    public function updateTask($id, array $data)
    {
        $task = $this->findTaskById($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        $task = $this->findTaskById($id);
        return $task->delete();
    }
}