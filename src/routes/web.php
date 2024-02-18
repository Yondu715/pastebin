<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OAuth\AuthGoogleController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ComplaintController;
use App\Http\Controllers\Web\PasteController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('/{id}/ban', [UserController::class, 'ban'])
                ->name('ban');
        });
});

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::middleware('guest')
            ->group(function () {
                Route::get('/login', [AuthController::class, 'getLoginForm'])->name('login');
                Route::get('/register', [AuthController::class, 'getRegisterForm'])->name('register');
                Route::post('/login', [AuthController::class, 'login']);
                Route::post('/register', [AuthController::class, 'register']);
            });
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
            ->middleware('auth');

        Route::get('/login/google', [AuthGoogleController::class, 'redirectToProvider'])->name('login.google');
        Route::get('/login/google/callback', [AuthGoogleController::class, 'handleProviderCallback']);
    });

Route::prefix('pastes')
    ->name('pastes.')
    ->middleware('role:user')
    ->group(function () {
        Route::middleware('auth')
            ->group(function () {
                Route::get('/private', [PasteController::class, 'getPrivatePastes'])->name('private');
                Route::get('/{pasteId}/complaint/create', [ComplaintController::class, 'create'])->name('complaint.create');
                Route::post('/{pasteId}/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
            });
        Route::get('/', [PasteController::class, 'index'])->name('index');
        Route::post('/', [PasteController::class, 'store'])->name('store');
        Route::get('/create', [PasteController::class, 'create'])->name('create');
        Route::get('/{hash}', [PasteController::class, 'show'])->name('show');
    });
