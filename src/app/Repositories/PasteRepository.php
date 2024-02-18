<?php

namespace App\Repositories;

use App\Domain\Enums\AccessRestriction\AccessRestrictionTypeId;
use App\Domain\DTO\CreatePasteDto;
use App\Models\Paste;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        /** @var Paste|null*/
        return Paste::query()->create([
            'title' => $createPasteDto->title,
            'text' => $createPasteDto->text,
            'author_id' => $createPasteDto->authorId,
            'programming_language_id' => $createPasteDto->programmingLanguageId,
            'access_restriction_id' => $createPasteDto->accessRestrictionId,
            'hash' => Str::random(10),
            'expires_at' => $minutes ? now()->addMinutes($minutes) : null
        ]);
    }

    /**
     * [Description for getLatestPublic]
     *
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPublic(): Collection
    {
        return Paste::query()->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->available()
            ->where([
                'access_restriction_id' => AccessRestrictionTypeId::PUBLIC_ID
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
        return Paste::query()->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->available()
            ->where([
                'author_id' => $authorId
            ])->latest()->limit(10)->get();
    }

    /**
     * [Description for getByAuthor]
     *
     * @param int $authorId
     * 
     * @return LengthAwarePaginator
     * 
     */
    public function getByAuthor(int $authorId): LengthAwarePaginator
    {
        return Paste::query()->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->available()
            ->where([
                'author_id' => $authorId
            ])->paginate(10);
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
        return Paste::query()->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->available()
            ->firstWhere([
                'hash' => $hash
            ]);
    }
}
