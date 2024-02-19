<?php

namespace App\Repositories;

use App\Domain\DTO\CreatePasteDto;
use App\Domain\Enums\AccessRestriction\AccessRestrictionTypeId;
use App\Models\Paste;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;

class PasteRepository extends BaseRepository
{

    /**
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return Paste::class;
    }


    /**
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
     *
     * @param int $id
     * 
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPrivatePastes(int $id): Collection
    {
        return $this->model->query()
            ->where([
                'author_id' => $id
            ])
            ->where(function (Builder $builder) {
                return $builder->where('expires_at', null)
                    ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->limit(10)
            ->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->get();
    }

    /**
     *
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPublicPastes(): Collection
    {
        return $this->model->query()
            ->where([
                'access_restriction_id' => AccessRestrictionTypeId::PUBLIC_ID
            ])
            ->where(function (Builder $builder) {
                return $builder->where('expires_at', null)
                    ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->limit(10)
            ->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->get();
    }

    /**
     *
     * @param int $id
     * 
     * @return LengthAwarePaginator
     * 
     */
    public function getPrivatePastes(int $id): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('author_id', $id)
            ->where(function (Builder $builder) {
                return $builder->where('expires_at', null)
                    ->orWhere('expires_at', '>', now());
            })
            ->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->latest()
            ->paginate(10);
    }

    /**
     *
     * @param string $hash
     * 
     * @return Paste|null
     * 
     */
    public function getByHash(string $hash): ?Paste {
        /** @var Paste|null */
        return $this->model->query()
            ->where([
                'hash' => $hash
            ])
            ->where(function (Builder $builder) {
                return $builder->where('expires_at', null)
                    ->orWhere('expires_at', '>', now());
            })
            ->with(['programmingLanguage', 'author', 'accessRestriction'])
            ->first();
    }
}
