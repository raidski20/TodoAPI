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
        $firstUser = User::find(1);
        $secondUser = User::find(2);

        $tasks = [
            [
                'user_id' => $firstUser->id,
                'title' => 'First Task',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'status' => StatusType::IN_PTOGRESS,
            ],
            [
                'user_id' => $firstUser->id,
                'title' => 'Second Task',
                'description' => '',
                'status' => StatusType::FINISHED,
            ],
            [
                'user_id' => $secondUser->id,
                'title' => 'Third Task',
                'description' => '',
                'status' => StatusType::IN_PTOGRESS,
            ],
            [
                'user_id' => $secondUser->id,
                'title' => 'Fourth Task',
                'description' => 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
                'status' => StatusType::IN_PTOGRESS,
            ]
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
