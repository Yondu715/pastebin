<?php

namespace App\Exceptions;

use Exception;

class PasteException extends Exception
{
    /**
     * [Description for notFound]
     *
     * @param mixed $param
     * 
     * @return PasteException
     * 
     */
    public static function notFound(mixed $param): PasteException
    {
        return new self("Паста с параметром $param не была найдена", 404);
    }
}
