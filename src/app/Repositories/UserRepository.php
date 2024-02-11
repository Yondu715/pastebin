<?php

namespace App\Repositories;

use App\Dto\RegisterDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'role_id' => 2
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
     * [Description for getByEmailAndPassword]
     *
     * @param string $email
     * @param string $password
     * 
     * @return User|null
     * 
     */
    public function getByEmailAndPassword(string $email, string $password): ?User {
        return User::query()->where([
            'email' => $email,
            'password' => Hash::make($password)
        ])->first();
    }
}
