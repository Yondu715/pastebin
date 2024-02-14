<?php

namespace App\Repositories;

use App\DTO\CreatePasteDto;
use App\Models\AccessRestriction;
use App\Models\Paste;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PasteRepository
{
    /**
     * [Description for create]
     *
     * @param CreatePasteDto $createPasteDto
     * @param int|null $minutes
     * 
     * @return Paste
     * 
     */
    public function create(CreatePasteDto $createPasteDto, int|null $minutes): Paste
    {
        $paste = new Paste([
            'title' => $createPasteDto->title,
            'text' => $createPasteDto->text,
            'author_id' => $createPasteDto->authorId,
            'programming_language_id' => $createPasteDto->programmingLanguageId,
            'access_restriction_id' => $createPasteDto->accessRestrictionId,
            'hash' => Str::random(10),
            'expires_at' => $minutes ? now()->addMinutes($minutes) : null
        ]);
        $paste->save();
        return $paste;
    }

    /**
     * [Description for getLatestPublic]
     *
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPublic(): Collection
    {
        return Paste::query()->where([
            'access_restriction_id' => AccessRestriction::PUBLIC
        ])->latest()->limit(10)->get();
    }

    /**
     * [Description for getLatestByAuthor]
     *
     * @param int $authorId
     * 
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestByAuthor(int $authorId): Collection
    {
        return Paste::query()->where([
            'author_id' => $authorId
        ])->latest()->limit(10)->get();
    }

    /**
     * [Description for getByAuthor]
     *
     * @param int $authorId
     * 
     * @return Collection<int,Paste>
     * 
     */
    public function getByAuthor(int $authorId): Collection
    {
        return Paste::query()->where([
            'author_id' => $authorId
        ])->get();
    }

    /**
     * [Description for getByHash]
     *
     * @param string $hash
     * 
     * @return Paste|null
     * 
     */
    public function getByHash(string $hash): ?Paste
    {
        return Paste::query()->where([
            'hash' => $hash
        ])->first();
    }
}
