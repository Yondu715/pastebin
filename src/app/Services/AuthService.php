<?php

namespace App\Services;

use App\DTO\CreateUserDto;
use App\DTO\LoginDto;
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
     * @param CreateUserDto $createUserDto
     * 
     * @return User
     * 
     */
    public function register(CreateUserDto $createUserDto): User
    {
        if ($this->userRepository->getByEmail($createUserDto->email)) {
            throw UserException::conflict($createUserDto->email);
        }
        $user = $this->userRepository->create($createUserDto);
        return $user;
    }

    /**
     * [Description for login]
     *
     * @param LoginDto $loginDto
     * 
     * @return User
     * 
     */
    public function login(LoginDto $loginDto): User
    {
        $user = $this->userRepository->getByEmail($loginDto->email);
        if (!$user || !Hash::check($loginDto->password, $user->password)) {
            throw UserException::invalidCredentials();
        }
        if ($user->is_banned) {
            throw UserException::isBanned();
        }
        if ($loginDto->remember) {
            $user->updateRememberToken();
        }
        return $user;
    }

    public function registerViaSocial(CreateUserDto $createUserDto)
    {
    }
}
