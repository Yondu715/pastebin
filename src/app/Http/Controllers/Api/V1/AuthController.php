<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\DTO\LoginDto;
use App\Domain\DTO\CreateUserDto;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    /**
     * Авторизация
     *
     * @param LoginRequest $loginRequest
     * 
     * @return JsonResponse
     * 
     * @throws UserException
     * 
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $user = $this->authService->login(
            LoginDto::fromRequest($loginRequest)
        );
        $token = $user->createToken('auth')->accessToken;
        return response()->json([
            'data' => [
                'accessToken' => $token,
                'user' => UserResource::make($user)
            ]
        ], 200);
    }

    /**
     * Регистрация
     *
     * @param RegisterRequest $registerRequest
     * 
     * @return UserResource
     * 
     * @throws UserException
     * 
     */
    public function register(RegisterRequest $registerRequest): UserResource
    {
        $user = $this->authService->register(
            CreateUserDto::fromRequest($registerRequest)
        );
        return UserResource::make($user);
    }

    /**
     * Выход
     *
     * @return void
     * 
     */
    public function logout(): void
    {
        /** @var User $user */
        $user = auth()->user();
        $user->token()->revoke();
    }
}
