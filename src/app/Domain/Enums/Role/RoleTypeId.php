<?php

namespace App\Domain\Enums\Role;

enum RoleTypeId: int {
    
     /** Админ */
    case ADMIN_ID = 1;

    /** Пользователь */
    case USER_ID = 2;
}