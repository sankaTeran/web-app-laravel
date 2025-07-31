<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email_verified_at' => now(),
                    'password' => bcrypt('oauth_password'),
                ]
            );

            Auth::login($user);

            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['oauth' => 'Login failed. Please try again.']);
        }
    }


    // public function callback($provider)
    // {
    //     $socialUser = Socialite::driver($provider)->user();

    //     $user = User::firstOrCreate(
    //         ['email' => $socialUser->getEmail()],
    //         [
    //             'name' => $socialUser->getName() ?? $socialUser->getNickname(),
    //             'email_verified_at' => now(),
    //             'password' => bcrypt('oauth_password'), // Placeholder
    //         ]
    //     );

    // //     if (!$user->hasAnyRole(['admin', 'editor', 'reader'])) {
    // //     $user->assignRole('reader'); // or 'admin', 'editor'
    // // }

    //     Auth::login($user);

    //     return redirect()->intended('/dashboard');
    // }
}
