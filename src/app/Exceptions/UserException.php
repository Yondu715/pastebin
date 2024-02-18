<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserException extends Exception
{

    /**
     * [Description for render]
     *
     * @return JsonResponse
     * 
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $this->message
            ]
        ], $this->code);
    }

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
