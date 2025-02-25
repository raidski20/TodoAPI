<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTrait;
    
    public function register(AuthRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            'password' => Hash::make($validated["password"])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendSuccessResponse(
            new UserResource($user, $token),
        );
    }

    public function login(AuthRequest $request)
    {
        $validated = $request->validated();
        
        $user = User::where("email", $validated["email"])->first();

        if (!$user || !Hash::check($validated["password"], $user->password)) 
        {
            return $this->sendErrorResponse(
                error: 'incorrect username or password',
                code: 401
            );
        }
        else
        {
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendSuccessResponse(
                new UserResource($user, $token),
            );
        }
    }
}
