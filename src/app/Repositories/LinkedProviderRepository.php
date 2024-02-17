<?php

namespace App\Repositories;

use App\DTO\CreateLinkedProviderDto;
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
        return LinkedProvider::query()->with('user')->where([
            'provider_id' => $providerId,
            'provider_name' => $providerName
        ])->first();
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
        $linkedProvider = new LinkedProvider([
            'provider_id' => $createLinkedProviderDto->providerId,
            'provider_name' => $createLinkedProviderDto->providerName,
            'user_id' => $createLinkedProviderDto->userId
        ]);
        return $linkedProvider;
    }
}
