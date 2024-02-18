<?php

namespace App\Repositories;

use App\Models\ExpirationTime;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class ExpirationTimeRepository extends BaseRepository
{

    /**
     * [Description for model]
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return ExpirationTime::class;
    }

}
