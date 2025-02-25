<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $tags = [
            [
                'user_id' => $user->id,
                'name' => 'Work'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Life'
            ]
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
