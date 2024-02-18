<?php

namespace App\Services;

use App\Models\AccessRestriction;
use App\Repositories\AccessRestrictionRepository;
use Illuminate\Database\Eloquent\Collection;

class AccessRestrictionService
{

    public function __construct(
        private readonly AccessRestrictionRepository $accessRestrictionRepository
    ) {
    }

    /**
     * Получение всех типов доступа
     *
     * @return Collection<int,AccessRestriction>
     * 
     */
    public function getAll(): Collection
    {
        return $this->accessRestrictionRepository->all();
    }
}
