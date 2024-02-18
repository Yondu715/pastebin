<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 */
class Role extends \TCG\Voyager\Models\Role
{
    use HasFactory;
}
