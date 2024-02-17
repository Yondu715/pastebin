<?php

namespace App\Services;

use App\Dto\CreateSocialiteUserDto;
use App\DTO\CreateUserDto;
use App\DTO\LoginDto;
use App\Exceptions\UserException;
use App\Models\User;
use App\Repositories\LinkedProviderRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function __construct(
        private UserRepository $userRepository,
        private LinkedProviderRepository $linkedProviderRepository
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

    /**
     * [Description for loginViaSocial]
     *
     * @param CreateSocialiteUserDto $createSocialiteUserDto
     * @param string $provider
     * 
     * @return User
     * 
     */
    public function loginViaSocial(CreateSocialiteUserDto $createSocialiteUserDto, string $provider): User
    {
        $linkedProvider = $this->linkedProviderRepository->getByProviderIdAndProviderName($createSocialiteUserDto->id, $provider);
        if ($linkedProvider && $linkedProvider->user) {
            return $linkedProvider->user;
        }
        if ($this->userRepository->getByEmail($createSocialiteUserDto->email)) {
            throw UserException::conflict($createSocialiteUserDto->email);
        }
        $user = $this->userRepository->createFromSocialite($createSocialiteUserDto);
        $linkedProvider = $this->linkedProviderRepository->create($createSocialiteUserDto->id, $provider, $user->id);
        return $user;
    }
}
