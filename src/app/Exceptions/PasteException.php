<?php

namespace App\Exceptions;

use Exception;

class PasteException extends Exception
{
    public static function notFound(mixed $param) {
        return new self("Паста с параметром $param не была найдена", 404);
    }
}
