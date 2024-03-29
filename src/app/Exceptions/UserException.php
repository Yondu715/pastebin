<?php

namespace App\Exceptions;

class UserException extends BaseException
{

    /**
     * [Description for conflict]
     *
     * @param string $email
     * 
     * @return UserException
     * 
     */
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
    public static function unauthorized(): UserException
    {
        return new self("Пользователь неавторизован", 401);
    }

    /**
     * [Description for isBanned]
     *
     * @return UserException
     * 
     */
    public static function isBanned(): UserException
    {
        return new self("Пользователь забанен", 403);
    }

    /**
     * [Description for invalidCredentials]
     *
     * @return UserException
     * 
     */
    public static function invalidCredentials(): UserException
    {
        return new self("Неверный логин или пароль", 401);
    }
}
