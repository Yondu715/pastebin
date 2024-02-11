<?php

namespace App\Services;

use App\DTO\CreatePasteDto;
use App\Models\Paste;
use App\Repositories\ExpirationTimeRepository;
use App\Repositories\PasteRepository;

class PasteService
{

    public function __construct(
        private ExpirationTimeRepository $expirationTimeRepository,
        private PasteRepository $pasteRepository
    ) {
    }

    public function createPaste(CreatePasteDto $createPasteDto): Paste
    {
        $expirationTime = $this->expirationTimeRepository->getById($createPasteDto->expirationTimeId);
        $paste = $this->pasteRepository->create($createPasteDto, $expirationTime->minutes);
        return $paste;
    }
}
