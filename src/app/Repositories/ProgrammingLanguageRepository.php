<?php

namespace App\Repositories;

use App\Models\ProgrammingLanguage;
use Prettus\Repository\Eloquent\BaseRepository;

class ProgrammingLanguageRepository extends BaseRepository
{

    /**
     * [Description for model]
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return ProgrammingLanguage::class;
    }

}
