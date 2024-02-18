<?php

namespace App\Services;

use App\Domain\DTO\CreateLinkedProviderDto;
use App\Domain\DTO\CreateSocialiteUserDto;
use App\Domain\DTO\CreateUserDto;
use App\Domain\DTO\LoginDto;
use App\Domain\Enums\Linkedprovider\LinkedProviderType;
use App\Exceptions\UserException;
use App\Models\LinkedProvider;
use App\Models\User;
use App\Repositories\LinkedProviderRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly LinkedProviderRepository $linkedProviderRepository
    ) {
    }

    /**
     * Регистрация
     *
     * @param CreateUserDto $createUserDto
     * 
     * @return User
     * 
     * @throws UserException
     * 
     */
    public function register(CreateUserDto $createUserDto): User
    {
        if ($this->userRepository->findWhere(['email' => $createUserDto->email])) {
            throw UserException::conflict($createUserDto->email);
        }
        return $this->userRepository->createFromDto($createUserDto);
    }

    /**
     * Авторизация
     *
     * @param LoginDto $loginDto
     * 
     * @return User
     * 
     * @throws UserException
     * 
     */
    public function login(LoginDto $loginDto): User
    {
        /** @var User|null */
        $user = $this->userRepository->findWhere(['email' => $loginDto->email]);
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
     * Авторизация через соцсети
     *
     * @param CreateSocialiteUserDto $createSocialiteUserDto
     * @param LinkedProviderType $provider
     * 
     * @return User
     * 
     * @throws UserException
     * 
     */
    public function loginViaSocial(CreateSocialiteUserDto $createSocialiteUserDto, LinkedProviderType $provider): User
    {
        /** @var LinkedProvider|null */
        $linkedProvider = $this->linkedProviderRepository->with('user')->findWhere([
            'provider_id' => $createSocialiteUserDto->id,
            'provider_name' => $provider
        ]);
        if ($linkedProvider) {
            return $linkedProvider->user;
        }
        if ($this->userRepository->findWhere(['email' => $createSocialiteUserDto->email])) {
            throw UserException::conflict($createSocialiteUserDto->email);
        }
        $user = $this->userRepository->createFromSocialite($createSocialiteUserDto);
        $createLinkedProviderDto = new CreateLinkedProviderDto(
            $createSocialiteUserDto->id,
            $provider,
            $user->id
        );
        $linkedProvider = $this->linkedProviderRepository->createFromDto($createLinkedProviderDto);
        return $user;
    }
}
