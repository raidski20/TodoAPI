<?php

namespace App\Repositories;

use App\Contracts\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface{

    public function __construct(
        public User $user
    ) {}

    public function createUser(array $data): User
    {
        $this->user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            'password' => Hash::make($data["password"])
        ]);
        return $this->user;
    }

    public function checkUser(array $data): ?User
    {
        $this->user = User::where("email", $data["email"])->first();

        if (!$this->user || 
            !Hash::check($data["password"], $this->user->password)
            ) 
        {
            return null;
        }
        
        return $this->user;
    }
}