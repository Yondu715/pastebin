<?php

namespace App\Repositories;

use App\Domain\DTO\CreateLinkedProviderDto;
use App\Models\LinkedProvider;
use Prettus\Repository\Eloquent\BaseRepository;

class LinkedProviderRepository extends BaseRepository
{

    /**
     * [Description for model]
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return LinkedProvider::class;
    }

    /**
     * [Description for create]
     *
     * @param CreateLinkedProviderDto $createLinkedProviderDto
     * 
     * @return LinkedProvider
     * 
     */
    public function createFromDto(CreateLinkedProviderDto $createLinkedProviderDto): LinkedProvider
    {
        /** @var LinkedProvider */
        return LinkedProvider::query()->create([
            'provider_id' => $createLinkedProviderDto->providerId,
            'provider_name' => $createLinkedProviderDto->providerName,
            'user_id' => $createLinkedProviderDto->userId
        ]);
    }
}
