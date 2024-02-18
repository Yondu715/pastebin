<?php

namespace App\Domain\DTO;

use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class CreateSocialiteUserDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {
    }

    public static function fromSocialite(SocialiteUser $user): CreateSocialiteUserDto
    {
        return new self(
            $user->getId(),
            $user->getName(),
            $user->getEmail(),
            Hash::make('123456789')
        );
    }
}
