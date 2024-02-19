<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $text
 * @property User $author
 * @property AccessRestrinction $accessRestriction
 * @property ProgrammingLanguage $programmingLanguage
 * @property timestamp $expires_at
 * @property string $hash
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

}
