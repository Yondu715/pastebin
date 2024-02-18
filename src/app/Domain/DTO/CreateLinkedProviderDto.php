<?php

namespace App\Domain\DTO;

use App\Domain\Enums\Linkedprovider\LinkedProviderType;

class CreateLinkedProviderDto
{
    public function __construct(
        public readonly string $providerId,
        public readonly LinkedProviderType $providerName,
        public readonly int $userId
    ) {
    }
}
