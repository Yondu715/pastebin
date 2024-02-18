<?php

namespace App\Http\Controllers\OAuth;

use App\Domain\DTO\CreateSocialiteUserDto;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthGoogleController extends Controller
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(): RedirectResponse
    {
        $socialiteUser = Socialite::driver('google')->user();
        $createSocialiteUserDto = CreateSocialiteUserDto::fromSocialite($socialiteUser);
        $user = $this->authService->loginViaSocial($createSocialiteUserDto, 'google');
        Auth::login($user);
        return redirect()->route('pastes.index');
    }
}
