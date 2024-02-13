<?php

use App\Http\Controllers\Web\AuthController;
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

Route::get('/home', function () {
    return view('pages.home.home');
})->name('home');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'getLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'getRegisterForm'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

