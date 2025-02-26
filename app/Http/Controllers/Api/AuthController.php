<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Traits\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;
    
    public function register(AuthService $authService, AuthRequest $request)
    {
        $validated = $request->validated();

        $user = $authService->registerUser($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendSuccessResponse(
            new UserResource($user, $token),
        );
    }

    public function login(AuthService $authService, AuthRequest $request)
    {
        $validated = $request->validated();

        $user = $authService->checkUser($validated);

        if (!$user) {
            return $this->sendErrorResponse(
                error: 'Incorrect username or password',
                code: 401
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendSuccessResponse(
            new UserResource($user, $token),
        );   
    }
}
