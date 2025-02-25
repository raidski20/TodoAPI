<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Tag;

class TaskTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::get();
        $tags = Tag::pluck('id');

        foreach ($tasks as $task) {
            $task->tags()
                ->attach($tags, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]); 
        }
    }
}
