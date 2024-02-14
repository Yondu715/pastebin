<?php

namespace App\Repositories;

use App\Models\ProgrammingLanguage;
use Illuminate\Database\Eloquent\Collection;

class ProgrammingLanguageRepository
{

    /**
     * [Description for getAll]
     *
     * @return Collection<int,ProgrammingLanguage>
     * 
     */
    public function getAll(): Collection
    {
        return ProgrammingLanguage::all();
    }
}
