<?php

namespace App\Repositories;

use App\Models\ProgrammingLanguage;
use Prettus\Repository\Eloquent\BaseRepository;

class ProgrammingLanguageRepository extends BaseRepository
{

    /**
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return ProgrammingLanguage::class;
    }

}
