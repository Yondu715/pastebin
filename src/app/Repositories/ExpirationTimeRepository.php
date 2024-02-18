<?php

namespace App\Repositories;

use App\Models\ExpirationTime;
use Illuminate\Database\Eloquent\Collection;

class ExpirationTimeRepository
{
    public function getById(int $id): ?ExpirationTime
    {
        /** @var ExpirationTime*/
        return ExpirationTime::query()->find($id);
    }

    /**
     * [Description for getAll]
     *
     * @return Collection<int,ExpirationTime>
     * 
     */
    public function getAll(): Collection
    {
        return ExpirationTime::all();
    }
}
