<?php

namespace App\Repositories;

use App\Models\ExpirationTime;
use Illuminate\Database\Eloquent\Collection;

class ExpirationTimeRepository
{
    public function getById(int $id): ?ExpirationTime
    {
        return ExpirationTime::query()->where([
            'id' => $id
        ])->first();
    }

    public function getAll(): Collection
    {
        return ExpirationTime::all();
    }
}
