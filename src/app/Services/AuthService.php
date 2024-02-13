<?php

namespace App\Services;

use App\DTO\LoginDto;
use App\DTO\RegisterDto;
use App\Exceptions\UserException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * [Description for register]
     *
     * @param RegisterDto $registerDto
     * 
     * @return User
     * 
     */
    public function register(RegisterDto $registerDto): User
    {
        if ($this->userRepository->getByEmail($registerDto->email)) {
            throw UserException::conflict($registerDto->email);
        }
        $user = $this->userRepository->create($registerDto);
        return $user;
    }

    /**
     * [Description for login]
     *
     * @param LoginDto $loginDto
     * 
     * @return string
     * 
     */
    public function login(LoginDto $loginDto): string
    {
        $user = $this->userRepository->getByEmail($loginDto->email);
        if (!$user || !Hash::check($loginDto->password, $user->password)) {
            throw UserException::unauthorized();
        }
        if ($user->is_banned) {
            throw UserException::isBanned();
        }
        $token = $user->createToken('auth')->accessToken;
        return $token;
    }
}
