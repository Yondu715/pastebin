<?php

namespace App\Repositories;

use App\Models\AccessRestriction;
use Prettus\Repository\Eloquent\BaseRepository;

class AccessRestrictionRepository extends BaseRepository
{

    /**
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return AccessRestriction::class;
    }
}
