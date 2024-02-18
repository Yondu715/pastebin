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
        $loginDto = LoginDto::fromRequest($loginRequest);
        try {
            $user = $this->authService->login($loginDto);
            $token = $user->createToken('auth')->accessToken;
            return response()->json([
                'data' => [
                    'accessToken' => $token,
                    'user' => UserResource::make($user)
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
     * Регистрация
     *
     * @param RegisterRequest $registerRequest
     * 
     * @return UserResource
     * 
     * @throws UserException
     * 
     */
    public function register(RegisterRequest $registerRequest): UserResource|JsonResponse
    {
        $createUserDto = CreateUserDto::fromRequest($registerRequest);
        try {
            $user = $this->authService->register($createUserDto);
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
