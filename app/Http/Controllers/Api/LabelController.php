<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabelRequest;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    
    public function index(Request $request)
    {
        $labels = $request->user()->labels;

        return response()->json([
            'data' => $labels,
            'message' => ''
        ], 200);
    }

    public function store(LabelRequest $request)
    {
        $validated = $request->validated();
        $labels = $request->user()->labels()->create($validated);

        return response()->json([
            'data' => $labels,
            'message' => 'Success'
        ], 200);
    }

    public function update(LabelRequest $request, string $id)
    {
        $label = $request->user()->labels()->findOrFail($id);

        $validated = $request->validated();

        $label->update($validated);

        return response()->json([
            'data' => $label,
            'message' => 'Success'
        ], 200);
    }

    public function destroy(string $id)
    {
        $task = auth()->user()->labels()->findOrFail($id);

        $task->delete();
    
        return response()->json([
            'data' => '',
            'message' => 'Task deleted successfully.',
        ], 200);
    }
}
