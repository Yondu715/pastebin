<?php

namespace App\Repositories;

use App\DTO\CreatePasteDto;
use App\Models\Paste;
use Illuminate\Support\Str;

class PasteRepository
{
    public function create(CreatePasteDto $createPasteDto, int $minutes)
    {
        $paste = new Paste([
            'title' => $createPasteDto->title,
            'text' => $createPasteDto->text,
            'author_id' => $createPasteDto->authorId,
            'programming_language_id' => $createPasteDto->programmingLanguageId,
            'access_restriction_id' => $createPasteDto->accessRestrictionId,
            'hash' => Str::random(10),
            'expires_at' => now()->addMinutes($minutes)
        ]);
        $paste->save();
        return $paste;
    }
}
