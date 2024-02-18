<?php

namespace App\Domain\DTO;

use App\Http\Requests\LoginRequest;

class LoginDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly bool $remember
    ) {
    }

    public static function fromRequest(LoginRequest $loginRequest): LoginDto
    {
        return new self(
            $loginRequest->email,
            $loginRequest->password,
            $loginRequest->remember ? true : false
        );
    }
}
