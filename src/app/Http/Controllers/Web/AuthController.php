<?php

namespace App\Http\Controllers\Web;

use App\DTO\LoginDto;
use App\DTO\CreateUserDto;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    public function getLoginForm(): View
    {
        return view('pages.auth.login');
    }

    public function getRegisterForm(): View
    {
        return view('pages.auth.register');
    }

    public function login(LoginRequest $loginRequest): RedirectResponse
    {
        $loginDto = LoginDto::fromRequest($loginRequest);
        try {
            $user = $this->authService->login($loginDto);
            Auth::login($user, $loginDto->remember);
            $loginRequest->session()->regenerate();
            return redirect()->route('pastes.index');
        } catch (UserException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function register(RegisterRequest $registerRequest): RedirectResponse
    {
        $createUserDto = CreateUserDto::fromRequest($registerRequest);
        try {
            $this->authService->register($createUserDto);
            return back()->with('success', 'Пользователь был успешно зарегистрирован');
        } catch (UserException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
