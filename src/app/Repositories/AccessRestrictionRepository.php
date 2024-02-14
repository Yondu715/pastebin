<?php

namespace App\Repositories;

use App\Models\AccessRestriction;
use Illuminate\Database\Eloquent\Collection;

class AccessRestrictionRepository
{

    /**
     * [Description for getAll]
     *
     * @return Collection<int,AccessRestriction>
     * 
     */
    public function getAll(): Collection
    {
        return AccessRestriction::all();
    }
}
