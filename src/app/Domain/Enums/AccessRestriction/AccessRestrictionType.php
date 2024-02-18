<?php 

namespace App\Domain\Enums\AccessRestriction;

enum AccessRestrictionTypeId: int {

    /** Публичный */
    case PUBLIC_ID = 1;

    /** По ссылке */
    case UNLISTED_ID = 2;

    /** Приватный */
    case PRIVATE_ID = 3;
}