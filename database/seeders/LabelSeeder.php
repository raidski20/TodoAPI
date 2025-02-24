<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Label;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $labels = [
            [
                'user_id' => $user->id,
                'name' => 'First Label'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Second label'
            ]
        ];

        foreach ($labels as $label) {
            Label::create($label);
        }
    }
}
