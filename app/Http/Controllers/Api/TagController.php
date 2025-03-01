<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TagRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Traits\ResponseTrait;

class tagController extends Controller
{
    use ResponseTrait;
    
    public function __construct(
        protected TagRepositoryInterface $tagRepository
    ) {}

    public function index()
    {
        $tags = $this->tagRepository->getAllTags();

        return $this->sendSuccessResponse(
            TagResource::collection($tags)
        );
    }

    public function store(TagRequest $request)
    {
        $validated = $request->validated();

        $tag = $this->tagRepository->createTag($validated);

        return $this->sendSuccessResponse(
            new TagResource($tag),
            'Tag created.',
        );
    }

    public function update(TagRequest $request, $id)
    {
        $validated = $request->validated();

        $tag = $this->tagRepository->updateTag($id, $validated);

        return $this->sendSuccessResponse(
            new TagResource($tag),
            'Tag updated.',
        );
    }

    public function destroy($id)
    {
        $this->tagRepository->deleteTag($id);

        return $this->sendSuccessResponse(
            message: 'Tag deleted.',
         );
    }
}
