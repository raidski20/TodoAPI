<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Label;

class TaskLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::get();
        $labels = Label::pluck('id');

        foreach ($tasks as $task) {
            $task->labels()
                ->attach($labels, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]); 
        }
    }
}
