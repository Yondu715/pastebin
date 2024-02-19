<?php

namespace App\Repositories;

use App\Domain\DTO\CreatePasteDto;
use App\Models\Paste;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;

class PasteRepository extends BaseRepository
{

    /**
     * [Description for model]
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return Paste::class;
    }


    /**
     * [Description for create]
     *
     * @param CreatePasteDto $createPasteDto
     * @param int|null $minutes
     * 
     * @return Paste
     * 
     */
    public function createFromDto(CreatePasteDto $createPasteDto, int|null $minutes): Paste
    {
        /** @var Paste */
        return $this->create([
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
     * [Description for getLatest]
     *
     * @param int $limit
     * 
     * @return Collection<int,Paste>
     * 
     */
    public function getLatest(int $limit): Collection
     {
        return $this->orderBy('created_at')->limit($limit);
    }

    /**
     * [Description for where]
     *
     * @param array<string,mixed> $where
     * 
     * @return PasteRepository
     * 
     */
    public function where(array $where): PasteRepository
    {
        return $this->scopeQuery(function ($query) use ($where) {
            return $query->where($where);
        });
    }

    /**
     * [Description for available]
     *
     * @return PasteRepository
     * 
     */
    public function available(): PasteRepository
    {
        return $this->scopeQuery(function ($query) {
            return $query->where([
                'expires_at' => null
            ])->orWhere('expires_at', '>', now());
        });
    }

    /**
     * [Description for withAllFields]
     *
     * @return PasteRepository
     * 
     */
    public function withAllFields(): PasteRepository
    {
        return $this->with(['programmingLanguage', 'author', 'accessRestriction']);
    }
}
