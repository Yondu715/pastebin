<?php

namespace App\Repositories;

use App\Models\ExpirationTime;

class ExpirationTimeRepository
{
    public function getById(int $id): ?ExpirationTime
    {
        return ExpirationTime::query()->where([
            'id' => $id
        ])->first();
    }
}
