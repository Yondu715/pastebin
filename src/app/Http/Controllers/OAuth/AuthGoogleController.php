<?php

namespace App\Http\Controllers\OAuth;

use App\DTO\CreateSocialiteUserDto;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('google')->stateless()->user();
        $createSocialiteUserDto = CreateSocialiteUserDto::fromSocialite($socialiteUser);
        $user = $this->authService->loginViaSocial($createSocialiteUserDto, 'google');
        Auth::login($user);
        return redirect()->route('pastes.index');
    }
}
