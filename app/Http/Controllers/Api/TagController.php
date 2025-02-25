<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;

class tagController extends Controller
{
    
    public function index(Request $request)
    {
        $tags = $request->user()->tags;

        return response()->json([
            'data' => $tags,
            'message' => ''
        ], 200);
    }

    public function store(TagRequest $request)
    {
        $validated = $request->validated();
        $tags = $request->user()->tags()->create($validated);

        return response()->json([
            'data' => $tags,
            'message' => 'Success'
        ], 200);
    }

    public function update(TagRequest $request, string $id)
    {
        $tag = $request->user()->tags()->findOrFail($id);

        $validated = $request->validated();

        $tag->update($validated);

        return response()->json([
            'data' => $tag,
            'message' => 'Success'
        ], 200);
    }

    public function destroy(string $id)
    {
        $task = auth()->user()->tags()->findOrFail($id);

        $task->delete();
    
        return response()->json([
            'data' => '',
            'message' => 'Task deleted successfully.',
        ], 200);
    }
}
