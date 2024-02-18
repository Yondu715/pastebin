<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class PasteException extends Exception
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
