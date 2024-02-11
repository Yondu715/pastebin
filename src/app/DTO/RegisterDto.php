<?php

namespace App\DTO;

use App\Http\Requests\RegisterRequest;

class RegisterDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromRequest(RegisterRequest $registerRequest): RegisterDto
    {
        return new self(
            $registerRequest->name,
            $registerRequest->email,
            $registerRequest->password
        );
    }
}
