<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService {

    public function getUserTasks(Request $request): Collection
    {
        return $request->user()
            ->tasks()
            ->filterByStatus($request->status)
            ->filterByTag($request->tag)
            ->get();
    }
}