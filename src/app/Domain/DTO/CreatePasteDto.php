<?php

namespace App\Domain\DTO;

use App\Http\Requests\CreatePasteRequest;

class CreatePasteDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $text,
        public readonly int|null $authorId,
        public readonly int|null $accessRestrictionId,
        public readonly int|null $programmingLanguageId,
        public readonly int|null $expirationTimeId,

    ) {
    }

    public static function fromRequest(CreatePasteRequest $createPasteRequest): CreatePasteDto
    {
        return new self(
            $createPasteRequest->title,
            $createPasteRequest->text,
            $createPasteRequest->authorId,
            $createPasteRequest->accessRestrictionId,
            $createPasteRequest->programmingLanguageId,
            $createPasteRequest->expirationTimeId,
        );
    }
}