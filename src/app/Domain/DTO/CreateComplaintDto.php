<?php

namespace App\Domain\DTO;

use App\Http\Requests\CreateComplaintRequest;

class CreateComplaintDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $text,
        public readonly int $pasteId,
        public readonly int $authorId
    )
    {
        
    }

    public static function fromRequest(CreateComplaintRequest $createComplaintRequest): CreateComplaintDto
    {
        return new self(
            $createComplaintRequest->title,
            $createComplaintRequest->text,
            $createComplaintRequest->pasteId,
            $createComplaintRequest->authorId,
        );
    }
}