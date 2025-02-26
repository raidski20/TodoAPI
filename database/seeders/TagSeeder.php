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
        $firstUser = User::find(1);
        $secondUser = User::find(2);

        $tags = [
            [
                'user_id' => $firstUser->id,
                'name' => 'work'
            ],
            [
                'user_id' => $firstUser->id,
                'name' => 'gym'
            ],
            [
                'user_id' => $secondUser->id,
                'name' => 'sports'
            ],
            [
                'user_id' => $secondUser->id,
                'name' => 'life'
            ]
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
