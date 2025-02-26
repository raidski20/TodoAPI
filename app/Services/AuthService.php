<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function __construct(
        private User $user
    ){}


    public function registerUser(array $userData): User
    {
        $this->user = User::create([
            "name" => $userData["name"],
            "email" => $userData["email"],
            'password' => Hash::make($userData["password"])
        ]);
        return $this->user;
    }

    public function checkUser(array $userData): ?User
    {
        $this->user = User::where("email", $userData["email"])->first();

        if (!$this->user || 
            !Hash::check($userData["password"], $this->user->password)
            ) 
        {
            return null;
        }
        
        return $this->user;
    }
}