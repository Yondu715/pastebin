<?php

namespace App\Http\Controllers\Web\OAuth;

use App\Domain\DTO\CreateSocialiteUserDto;
use App\Domain\Enums\Linkedprovider\LinkedProviderType;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthGoogleController extends Controller
{

    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    /**
     * Редирект на страницу авторизации провайдера
     *
     * @return RedirectResponse
     * 
     */
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver(LinkedProviderType::GOOGLE->value)->redirect();
    }

    /**
     * Авторизация пользователя
     *
     * @return RedirectResponse
     * 
     */
    public function handleProviderCallback(): RedirectResponse
    {
        $createSocialiteUserDto = CreateSocialiteUserDto::fromSocialite(
            Socialite::driver(LinkedProviderType::GOOGLE->value)->user()
        );
        Auth::login(
            $this->authService->loginViaSocial($createSocialiteUserDto, LinkedProviderType::GOOGLE)
        );
        return redirect()->route('pastes.index');
    }
}
