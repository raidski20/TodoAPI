<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseTrait;

    public function index(TaskService $taskService, Request $request)
    {
        $tasks = $taskService->getUserTasks($request);

        return $this->sendSuccessResponse(
            TaskResource::collection($tasks)
        );
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        
        $task = $request->user()->tasks()->create($validated);

        return $this->sendSuccessResponse(
           new TaskResource($task),
           'New Task created.',
        );
    }

    public function update(TaskRequest $request, TaskService $taskService, string $id)
    {
        /**
         * 1- check if user owns the requested task
         * 2- send error response when the task isn't found
         */
        $task = auth()->user()->tasks()->find($id);
        $taskService->SendErrorRessponseIfResourceNull($task);

        $validated = $request->validated();

        $task = $task->update($validated);

        return $this->sendSuccessResponse(
            new TaskResource($task),
            'Task updated.',
         );
    }

    public function destroy(TaskService $taskService, string $id)
    {
        $task = auth()->user()->tasks()->find($id);
        $taskService->SendErrorRessponseIfResourceNull($task);

        $task->delete();
    
        return $this->sendSuccessResponse(
            message: 'Task deleted.',
         );
    }
}
