<?php

namespace Database\Seeders;

use App\Enums\StatusType;
use App\Models\Task;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $tasks = [
            [
                'user_id' => $user->id,
                'title' => 'First Task',
                'description' => 'This is a test task 1',
                'status' => StatusType::IN_PTOGRESS,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Second Task',
                'description' => 'This is a test task 2',
                'status' => StatusType::FINISHED,
            ]
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
