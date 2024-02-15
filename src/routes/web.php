<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ComplaintController;
use App\Http\Controllers\Web\PasteController;
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
    Route::get('/login', [AuthController::class, 'getLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'getRegisterForm'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::prefix('pastes')
->name('pastes.')
->group(function () {
    Route::get('/create-form', [PasteController::class, 'getCreateForm'])->name('create');
    Route::post('/', [PasteController::class, 'store'])->name('store');
    Route::get('/', [PasteController::class, 'index'])->name('index');
    Route::get('/private', [PasteController::class, 'getPrivatePastes'])->name('private');
    Route::get('/{hash}', [PasteController::class, 'show'])->name('show');
    Route::get('/{pasteId}/complaint/create-form', [ComplaintController::class, 'getCreateForm'])->name('complaint.create');
    Route::post('/{pasteId}/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
});

