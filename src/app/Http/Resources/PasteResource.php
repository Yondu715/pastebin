<?php

namespace App\Http\Resources;

use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Paste
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
            'author' => UserResource::make($this->author),
            'hash' => $this->hash
        ];
    }
}
