<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->tasks();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
            

        if ($request->has('tag')) 
        {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        return response()->json([
            'data' => $query->get(),
            'message' => ''
        ], 200);
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $task = $request->user()->tasks()->create($validated);

        return response()->json([
            'data' => $task,
            'message' => 'Success'
        ], 200);
    }

    public function update(TaskRequest $request, string $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        $validated = $request->validated();

        $task->update($validated);

        return response()->json([
            'data' => $task,
            'message' => 'Success'
        ], 200);
    }

    public function destroy(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $task->delete();
    
        return response()->json([
            'data' => '',
            'message' => 'Task deleted successfully.',
        ], 200);
    }
}
