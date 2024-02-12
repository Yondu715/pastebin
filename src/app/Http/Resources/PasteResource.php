<?php

namespace App\Http\Resources;

use App\Models\ProgrammingLanguage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id,
 * @property string $title,
 * @property string $text,
 * @property ProgrammingLanguage $programmingLanguage,
 * @property User $author,
 * @property string $hash,
 */
class PasteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'programmingLanguage' => $this->programmingLanguage,
            'author' => $this->author,
            'hash' => $this->hash
        ];
    }
}
