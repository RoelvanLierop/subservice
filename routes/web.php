<?php

use App\Http\Controllers\SocialiteAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Prefix the auth URI's
Route::prefix('auth')->group(function () {
    // Route to call if you want to login with Github
    Route::get('redirect', function () {
        return Socialite::driver('github')->redirect();
    })->name('socialite_redirect');
    // Route to return to from Github
    Route::get('callback', [SocialiteAuthController::class, 'authenticate'])->name('socialite_callback');
});

require __DIR__.'/settings.php';
