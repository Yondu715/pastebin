<?php

namespace App\Exceptions;

class PasteException extends BaseException
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
