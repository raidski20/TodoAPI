<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class tagController extends Controller
{
    use ResponseTrait;
    
    public function index(Request $request)
    {
        $tags = $request->user()->tags;

        return $this->sendSuccessResponse(
            TagResource::collection($tags)
        );
    }

    public function store(TagRequest $request)
    {
        $validated = $request->validated();
        $tag = $request->user()->tags()->create($validated);

        return $this->sendSuccessResponse(
            new TagResource($tag),
            'New Tag created.',
        );
    }

    public function update(TagRequest $request, string $id)
    {
        $tag = $request->user()->tags()->findOrFail($id);

        $validated = $request->validated();

        $tag = $tag->update($validated);

        return $this->sendSuccessResponse(
            new TagResource($tag),
            'Tag updated.',
        );
    }

    public function destroy(string $id)
    {
        $task = auth()->user()->tags()->findOrFail($id);

        $task->delete();
    
        return $this->sendSuccessResponse(
            message: 'Tag deleted.',
         );
    }
}
