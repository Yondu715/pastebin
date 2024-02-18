<?php

namespace App\Repositories;

use App\Domain\DTO\CreatePasteDto;
use App\Models\Paste;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;

/**  
 * @method Builder|static available()
 * @method Builder|static withAllFields()
 */
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
}
