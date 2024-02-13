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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    public function getLoginForm()
    {
        return view('pages.auth.login');
    }

    public function getRegisterForm()
    {
        return view('pages.auth.register');
    }

    public function login(LoginRequest $loginRequest)
    {
        $loginDto = LoginDto::fromRequest($loginRequest);
        try {
            $user = $this->authService->login($loginDto);
            Auth::login($user, $loginDto->remember);
            $loginRequest->session()->regenerate();
            return redirect('home');
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login');
    }
}
