<?php

namespace App\Repositories;

use App\Domain\DTO\CreateLinkedProviderDto;
use App\Models\LinkedProvider;

class LinkedProviderRepository
{
    /**
     * [Description for getByProviderIdAndProviderName]
     *
     * @param string $providerId
     * @param string $providerName
     * 
     * @return LinkedProvider|null
     * 
     */
    public function getByProviderIdAndProviderName(string $providerId, string $providerName): ?LinkedProvider
    {
        /** @var LinkedProvider|null */
        return LinkedProvider::query()->with('user')->firstWhere([
            'provider_id' => $providerId,
            'provider_name' => $providerName
        ]);
    }

    /**
     * [Description for create]
     *
     * @param CreateLinkedProviderDto $createLinkedProviderDto
     * 
     * @return LinkedProvider
     * 
     */
    public function create(CreateLinkedProviderDto $createLinkedProviderDto): LinkedProvider
    {
        /** @var LinkedProvider */
        return LinkedProvider::query()->create([
            'provider_id' => $createLinkedProviderDto->providerId,
            'provider_name' => $createLinkedProviderDto->providerName,
            'user_id' => $createLinkedProviderDto->userId
        ]);
    }
}
