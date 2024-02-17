<?php

namespace App\Repositories;

use App\DTO\CreateSocialiteUserDto;
use App\DTO\CreateUserDto;
use App\Models\Role;
use App\Models\User;

class UserRepository
{
    /**
     * [Description for create]
     *
     * @param CreateUserDto $createUserDto
     * 
     * @return User
     * 
     */
    public function create(CreateUserDto $createUserDto): User
    {
        $user = new User([
            'email' => $createUserDto->email,
            'password' => $createUserDto->password,
            'name' => $createUserDto->name,
            'role_id' => Role::USER_ID
        ]);
        $user->save();
        return $user;
    }

    /**
     * [Description for createFromSocialite]
     *
     * @param CreateSocialiteUserDto $createSocialiteUserDto
     * 
     * @return User
     * 
     */
    public function createFromSocialite(CreateSocialiteUserDto $createSocialiteUserDto): User 
    {
        $user = new User([
            'email' => $createSocialiteUserDto->email,
            'password' => $createSocialiteUserDto->password,
            'name' => $createSocialiteUserDto->name,
            'role_id' => Role::USER_ID
        ]);
        $user->save();
        return $user;
    }

    /**
     * [Description for getByEmail]
     *
     * @param string $email
     * 
     * @return User|null
     * 
     */
    public function getByEmail(string $email): ?User
    {
        return User::query()->where([
            'email' => $email
        ])->first();
    }


    /**
     * [Description for updateBanStatus]
     *
     * @param int $userId
     * @param bool $status
     * 
     * @return User|null
     * 
     */
    public function updateBanStatus(int $userId, bool $status): ?User
    {
        /** @var User|null $user */
        $user = User::query()->find($userId);
        if ($user) {
            $user->is_banned = $status;
            $user->save();
        }
        return $user;
    }
}
