<?php

namespace App\Services;

use App\Models\ProgrammingLanguage;
use App\Repositories\ProgrammingLanguageRepository;
use Illuminate\Database\Eloquent\Collection;

class ProgrammingLanguageService
{

    public function __construct(
        private ProgrammingLanguageRepository $programmingLanguageRepository
    ) {
    }

    /**
     * [Description for getAll]
     *
     * @return Collection<int,ProgrammingLanguage>
     * 
     */
    public function getAll(): Collection
    {
        return $this->programmingLanguageRepository->getAll();
    }
}
