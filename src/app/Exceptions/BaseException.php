<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BaseException extends Exception
{
    /**
     * [Description for render]
     *
     * @return JsonResponse|RedirectResponse
     * 
     */
    public function render(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => [
                    'message' => $this->message
                ]
            ], $this->code);
        }
        return back()->with('error', $this->message);
    }
}
