<?php

namespace App\Http\Controllers\Web;

use App\DTO\LoginDto;
use App\DTO\RegisterDto;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    public function getLoginForm()
    {
        return view('auth.login');
    }

    public function getRegisterForm()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $loginRequest)
    {
        $loginDto = LoginDto::fromRequest($loginRequest);
        try {
            $this->authService->loginSession($loginDto);
            $loginRequest->session()->regenerate();
            return redirect('main');
        } catch (UserException $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function register(RegisterRequest $registerRequest): RedirectResponse
    {
        $registerDto = RegisterDto::fromRequest($registerRequest);
        try {
            $this->authService->register($registerDto);
            return back()->with('success', 'Пользователь был успешно зарегистрирован');
        } catch (UserException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('auth.login');
    }
}
