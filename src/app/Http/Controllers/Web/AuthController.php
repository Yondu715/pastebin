<?php

namespace App\Http\Controllers\Web;

use App\Domain\DTO\LoginDto;
use App\Domain\DTO\CreateUserDto;
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
        private readonly AuthService $authService
    ) {
    }

    /**
     * Форма авторизации
     *
     * @return View
     * 
     */
    public function getLoginForm(): View
    {
        return view('pages.auth.login');
    }

    /**
     * Форма регистрации
     *
     * @return View
     * 
     */
    public function getRegisterForm(): View
    {
        return view('pages.auth.register');
    }

    /**
     * Авторизация
     *
     * @param LoginRequest $loginRequest
     * 
     * @return RedirectResponse
     * 
     * @throws UserException
     * 
     */
    public function login(LoginRequest $loginRequest): RedirectResponse
    {
        $loginDto = LoginDto::fromRequest($loginRequest);
        Auth::login(
            $this->authService->login($loginDto),
            $loginDto->remember
        );
        $loginRequest->session()->regenerate();
        return redirect()->route('pastes.index');
    }

    /**
     * Регистрация
     *
     * @param RegisterRequest $registerRequest
     * 
     * @return RedirectResponse
     * 
     * @throws UserException
     * 
     */
    public function register(RegisterRequest $registerRequest): RedirectResponse
    {
        $this->authService->register(
            CreateUserDto::fromRequest($registerRequest)
        );
        return redirect()->route('auth.login')->with('success', 'Пользователь был успешно зарегистрирован');
    }

    /**
     * Выход
     *
     * @param Request $request
     * 
     * @return RedirectResponse
     * 
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
