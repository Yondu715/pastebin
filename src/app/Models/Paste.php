<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $text
 * @property User $author
 * @property AccessRestrinction $accessRestriction
 * @property timestamp $expires_at
 * @property string $hash
 * @method Builder|static available()
 * @method static Builder|static query()
 */
class Paste extends Model
{
    use HasFactory;

    protected $table = 'pastes';

    /**
     * hidden
     *
     * @var array<int, string>
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected $guarded = ['created_at', 'updated_at', 'id'];

    /**
     * author
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * accessRestrinction
     *
     * @return BelongsTo
     */
    public function accessRestriction(): BelongsTo
    {
        return $this->belongsTo(AccessRestriction::class);
    }

    /**
     * programmingLanguage
     *
     * @return BelongsTo
     */
    public function programmingLanguage(): BelongsTo
    {
        return $this->belongsTo(ProgrammingLanguage::class);
    }

    /**
     * [Description for scopeAvailable]
     *
     * @param Builder $builder
     * 
     * @return Builder
     * 
     */
    public function scopeAvailable(Builder $builder): Builder
    {
        return $builder->where([
            'expires_at' => null
        ])->orWhere('expires_at', '>', now());
    }
}
