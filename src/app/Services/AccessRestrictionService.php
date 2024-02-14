<?php

namespace App\Services;

use App\Models\AccessRestriction;
use App\Repositories\AccessRestrictionRepository;
use Illuminate\Database\Eloquent\Collection;

class AccessRestrictionService
{

    public function __construct(
        private AccessRestrictionRepository $accessRestrictionRepository
    ) {
    }

    /**
     * [Description for getAll]
     *
     * @return Collection<int,AccessRestriction>
     * 
     */
    public function getAll(): Collection
    {
        return $this->accessRestrictionRepository->getAll();
    }
}
