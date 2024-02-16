<?php

namespace App\Http\Controllers\OAuth;

use App\DTO\RegisterDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthGoogleController extends Controller
{
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('google')->stateless()->user();
        $registerUser = RegisterDto::fromSocialite($socialiteUser);
        return response()->json([$registerUser]);
    }
}
