<?php

namespace App\Repositories;

use App\Domain\Enums\Role\RoleTypeId;
use App\Domain\DTO\CreateSocialiteUserDto;
use App\Domain\DTO\CreateUserDto;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{

    /**
     * [Description for model]
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * [Description for create]
     *
     * @param CreateUserDto $createUserDto
     * 
     * @return User
     * 
     */
    public function createFromDto(CreateUserDto $createUserDto): User
    {
        /** @var User */
        return $this->create([
            'email' => $createUserDto->email,
            'password' => $createUserDto->password,
            'name' => $createUserDto->name,
            'role_id' => RoleTypeId::USER_ID
        ]);
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
        /** @var User */
        return $this->create([
            'email' => $createSocialiteUserDto->email,
            'password' => $createSocialiteUserDto->password,
            'name' => $createSocialiteUserDto->name,
            'role_id' => RoleTypeId::USER_ID

        ]);
    }


    public function getFirstByEmail(string $email): ?User
    {
        /** @var User|null */
        return $this->scopeQuery(function ($query) use ($email) {
            return $query->where([
                'email' => $email
            ]);
        })->first();
    }
}
