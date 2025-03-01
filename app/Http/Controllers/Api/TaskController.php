<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TaskRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseTrait;

    public function __construct(
        protected TaskRepositoryInterface $taskRepository
    ) {}

    public function index(Request $request)
    {
        $tasks = $this->taskRepository->getAllTasks(
            $request->query('status'),
            $request->query('tag')
        );

        return $this->sendSuccessResponse(
            TaskResource::collection($tasks)
        );
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        
        $task = $this->taskRepository->createTask($validated);

        return $this->sendSuccessResponse(
           new TaskResource($task),
           'Task created.',
        );
    }

    public function update(TaskRequest $request, $id)
    {
        $validated = $request->validated();

        $task = $this->taskRepository->updateTask($id, $validated);

        return $this->sendSuccessResponse(
            new TaskResource($task),
            'Task updated.',
         );
    }

    public function destroy($id)
    {
        $this->taskRepository->deleteTask($id);
    
        return $this->sendSuccessResponse(
            message: 'Task deleted.',
         );
    }
}
