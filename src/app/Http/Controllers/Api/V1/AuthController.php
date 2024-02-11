<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\LoginDto;
use App\DTO\RegisterDto;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    /**
     * [Description for login]
     *
     * @param LoginRequest $loginRequest
     * 
     * @return JsonResponse
     * 
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $loginDto = LoginDto::fromRequest($loginRequest);
        try {
            $token = $this->authService->login($loginDto);
            return response()->json([
                'data' => [
                    'accessToken' => $token
                ]
            ], 200);
        } catch (UserException $e) {
            return response()->json([
                'errors' => [
                    'message' => $e->getMessage()
                ]
            ], $e->getCode());
        }
    }

    /**
     * [Description for register]
     *
     * @param RegisterRequest $registerRequest
     * 
     * @return UserResource
     * 
     */
    public function register(RegisterRequest $registerRequest): UserResource|JsonResponse
    {
        $registerDto = RegisterDto::fromRequest($registerRequest);
        try {
            $user = $this->authService->register($registerDto);
            return UserResource::make($user);
        } catch (UserException $e) {
            return response()->json([
                'errors' => [
                    'message' => $e->getMessage()
                ]
            ], $e->getCode());
        }
    }

    /**
     * [Description for logout]
     *
     * @return JsonResponse
     * 
     */
    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->token()->revoke();
        return response()->json(200);
    }
}
