<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

Voyager::routes();

Route::prefix('users')
    ->name('users.')
    ->group(function () {
        Route::get('/{id}/ban', [UserController::class, 'ban'])
            ->name('ban');
    });
