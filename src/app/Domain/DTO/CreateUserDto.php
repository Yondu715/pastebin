<?php

namespace App\Domain\DTO;

use App\Http\Requests\RegisterRequest;

class CreateUserDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromRequest(RegisterRequest $registerRequest): CreateUserDto
    {
        return new self(
            $registerRequest->name,
            $registerRequest->email,
            $registerRequest->password
        );
    }
}
