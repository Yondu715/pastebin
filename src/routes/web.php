<?php

use App\Http\Controllers\OAuth\AuthGoogleController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ComplaintController;
use App\Http\Controllers\Web\PasteController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'getLoginForm'])
        ->name('login')
        ->middleware('guest');
    Route::get('/register', [AuthController::class, 'getRegisterForm'])
        ->name('register')
        ->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('guest');
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('guest');

    Route::get('/login/google', [AuthGoogleController::class, 'redirectToProvider'])->name('login.google');
    Route::get('/login/google/callback', [AuthGoogleController::class, 'handleProviderCallback']);
});

Route::prefix('pastes')
    ->name('pastes.')
    ->group(function () {
        Route::get('/create', [PasteController::class, 'create'])->name('create');
        Route::post('/', [PasteController::class, 'store'])->name('store');
        Route::get('/', [PasteController::class, 'index'])->name('index');
        Route::get('/private', [PasteController::class, 'getPrivatePastes'])
            ->name('private')
            ->middleware('auth');
        Route::get('/{hash}', [PasteController::class, 'show'])->name('show');
        Route::get('/{pasteId}/complaint/create', [ComplaintController::class, 'create'])
            ->name('complaint.create')
            ->middleware('auth');
        Route::post('/{pasteId}/complaint', [ComplaintController::class, 'store'])
            ->name('complaint.store')
            ->middleware('auth');
    });
