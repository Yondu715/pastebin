<?php

namespace App\Services;

use App\Models\ExpirationTime;
use App\Repositories\ExpirationTimeRepository;
use Illuminate\Database\Eloquent\Collection;

class ExpirationTimeService
{

    public function __construct(
        private readonly ExpirationTimeRepository $expirationTimeRepository
    ) {
    }

    /**
     * Получение всех вариантов ограничения по времени
     *
     * @return Collection<int,ExpirationTime>
     * 
     */
    public function getAll(): Collection
    {
        return $this->expirationTimeRepository->all();
    }
}
