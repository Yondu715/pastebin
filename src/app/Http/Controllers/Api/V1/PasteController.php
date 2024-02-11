<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\CreatePasteDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasteRequest;
use App\Http\Resources\PasteResource;
use App\Services\PasteService;

class PasteController extends Controller
{

    public function __construct(
        private PasteService $pasteService
    ) {
    }

    public function store(CreatePasteRequest $createPasteRequest): PasteResource
    {
        $createPasteDto = CreatePasteDto::fromRequest($createPasteRequest);
        $paste = $this->pasteService->createPaste($createPasteDto);
        return PasteResource::make($paste);
    }
}
