<?php

namespace App\Http\Resources;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id,
 * @property string $title,
 * @property string $text,
 * @property Paste $paste_id,
 * @property User $author,
 */
class ComplaintResource extends JsonResource
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
            'pasteId' => $this->paste_id,
            'author' => $this->author
        ];
    }
}
