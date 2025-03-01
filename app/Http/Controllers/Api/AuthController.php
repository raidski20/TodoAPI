<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Traits\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;

    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}
    
    public function register(AuthRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authRepository->createUser($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendSuccessResponse(
            new UserResource($user, $token),
        );
    }

    public function login(AuthRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authRepository->checkUser($validated);

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
