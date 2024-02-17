<?php

namespace App\Repositories;

use App\DTO\CreateLinkedProviderDto;
use App\Models\LinkedProvider;

class LinkedProviderRepository
{
    /**
     * [Description for getByProviderIdAndProviderName]
     *
     * @param int $providerId
     * @param string $providerName
     * 
     * @return LinkedProvider|null
     * 
     */
    public function getByProviderIdAndProviderName(string $providerId, string $providerName): ?LinkedProvider
    {
        return LinkedProvider::query()->with('user')->firstWhere([
            'provider_id' => $providerId,
            'provider_name' => $providerName
        ]);
    }

    /**
     * [Description for create]
     *
     * @param string $providerId
     * @param string $providerName
     * @param int $userId
     * 
     * @return LinkedProvider
     * 
     */
    public function create(CreateLinkedProviderDto $createLinkedProviderDto): LinkedProvider
    {
        $linkedProvider = new LinkedProvider([
            'provider_id' => $createLinkedProviderDto->providerId,
            'provider_name' => $createLinkedProviderDto->providerName,
            'user_id' => $createLinkedProviderDto->userId
        ]);
        return $linkedProvider;
    }
}
