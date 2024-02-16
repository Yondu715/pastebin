<?php

namespace App\Repositories;

use App\DTO\RegisterDto;
use App\Models\Role;
use App\Models\User;

class UserRepository
{
    /**
     * [Description for create]
     *
     * @param RegisterDto $registerDto
     * 
     * @return User
     * 
     */
    public function create(RegisterDto $registerDto): User
    {
        $user = new User([
            'email' => $registerDto->email,
            'password' => $registerDto->password,
            'name' => $registerDto->name,
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
