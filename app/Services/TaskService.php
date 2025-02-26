<?php

namespace App\Services;

use App\Models\Task;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService {

    use ResponseTrait;
    
    public function getUserTasks(Request $request): Collection
    {
        return $request->user()
            ->tasks()
            ->filterByStatus($request->status)
            ->filterByTag($request->tag)
            ->get();
    }

    public function SendErrorRessponseIfResourceNull(?Task $task)
    {
        if(!$task) 
        {
            $reponse = $this->sendErrorResponse(
                error: 'Not found',
                code: 404
            );
            abort($reponse);
        }
    }
}