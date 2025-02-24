<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Task;

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
                'status' => 'in_progress',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Second Task',
                'description' => 'This is a test task 2',
                'status' => 'finished',
            ]
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
