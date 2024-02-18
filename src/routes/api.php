<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ComplaintController;
use App\Http\Controllers\Api\V1\PasteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout'])
            ->middleware('auth:api');
    });

Route::prefix('pastes')
    ->group(function () {
        Route::middleware('auth:api')
            ->group(function () {
                Route::get('/private/new', [PasteController::class, 'getLatestPrivatePastes']);
                Route::get('/private', [PasteController::class, 'getPrivatePastes']);
            });
        Route::post('/', [PasteController::class, 'store']);
        Route::get('/{hash}', [PasteController::class, 'getPaste']);
        Route::get('/public/new', [PasteController::class, 'getLatestPublicPastes']);
    });

Route::prefix('complaints')
    ->group(function () {
        Route::post('/', [ComplaintController::class, 'store'])
            ->middleware('auth:api');
    });
