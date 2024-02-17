<?php

namespace App\DTO;

class CreateLinkedProviderDto
{
    public function __construct(
        public readonly string $providerId,
        public readonly string $providerName,
        public readonly int $userId
    ) {
    }
}
