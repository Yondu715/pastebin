<?php

namespace App\Repositories;

use App\Models\ExpirationTime;
use Prettus\Repository\Eloquent\BaseRepository;

class ExpirationTimeRepository extends BaseRepository
{

    /**
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return ExpirationTime::class;
    }

}
