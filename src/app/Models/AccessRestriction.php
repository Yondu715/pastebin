<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class AccessRestriction extends Model
{
    use HasFactory;

    const PUBLIC = 1;
    const UNLISTED = 2;
    const PRIVATE = 3;

    protected $table = 'access_restrictions';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['created_at', 'updated_at'];
}
