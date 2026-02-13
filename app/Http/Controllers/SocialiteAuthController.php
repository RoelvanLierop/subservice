<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Socialite;

class SocialiteAuthController extends Controller
{
    public function authenticate(): RedirectResponse
    {
        $oSocialiteUser = Socialite::driver('github')->user();

        // Check if we have a user
        if ($oSocialiteUser !== null) {

            // Check if the user has an email address
            if ($oSocialiteUser->getEmail() === null) {
                return $this->redirectWithError(['github_email' => 'Unable to login with Github. The email field is required. Please check your information on Github.']);
            }

            // if this went well, we can register a new user
            $user = User::updateOrCreate([
                'github_id' => $oSocialiteUser->id,
            ], [
                'name' => $oSocialiteUser->name,
                'email' => $oSocialiteUser->email,
                'password' => Hash::make($oSocialiteUser->email),
                'github_id' => $oSocialiteUser->id,
                'github_token' => $oSocialiteUser->token,
                'github_refresh_token' => $oSocialiteUser->refreshToken,
            ]);

            if (! $user) {
                return $this->redirectWithError(['app' => 'Unable to create user. Please contact support.']);
            }

            Auth::login($user, true);

            return Redirect::route('dashboard');
        }

        return $this->redirectWithError(['github_error' => 'Unable to login with Github. Please contact support.']);
    }

    private function redirectWithError(array $errors): RedirectResponse
    {
        return Redirect::to('/')->withErrors($errors);
    }
}
