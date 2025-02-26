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

    public function update(TaskRequest $request, string $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        $validated = $request->validated();

        $task = $task->update($validated);

        return $this->sendSuccessResponse(
            new TaskResource($task),
            'Task updated.',
         );
    }

    public function destroy(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $task->delete();
    
        return $this->sendSuccessResponse(
            message: 'Task deleted.',
         );
    }
}
