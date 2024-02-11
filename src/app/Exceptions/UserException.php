<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public static function conflict(string $email): UserException
    {
        return new self("Пользователь с почтой $email уже существует", 409);
    }

    /**
     * [Description for unauthorised]
     *
     * @return UserException
     * 
     */
    public static function unauthorised(): UserException
    {
        return new self("Пользователь неавторизован", 401);
    }
}
