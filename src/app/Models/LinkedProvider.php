<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $provider_id
 * @property string $provider_name
 * @property int $user_id
 * @property User $user
 */
class LinkedProvider extends Model
{
    use HasFactory;

    protected $table = 'linked_providers';

    protected $fillable = ['provider_id', 'provider_name', 'user_id'];

    /**
     * user
     *
     * @return BelongsTo
     * 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
