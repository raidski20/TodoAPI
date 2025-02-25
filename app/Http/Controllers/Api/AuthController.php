<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            'password' => Hash::make($validated["password"])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);

    }

    public function login(AuthRequest $request)
    {
        $validated = $request->validated();
        
        $user = User::where("email", $validated["email"])->first();

        if (!$user || !Hash::check($validated["password"], $user->password)) 
        {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }
        else
        {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }
    }
}
