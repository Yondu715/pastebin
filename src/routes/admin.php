<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

Voyager::routes();

Route::prefix('users')
    ->name('users.')
    ->group(function () {
        Route::post('/{id}/ban')
            ->name('ban');
    });
