<?php

use App\Http\Controllers\SocialiteAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;
use App\Http\Controllers\CheckoutController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Prefix the auth URI's
Route::prefix('auth')->group(function () {
    // GitHub Redirect URI
    Route::get('redirect', function () {
        return Socialite::driver('github')->redirect();
    })->name('socialite_redirect');

    // GitHub Callback URI
    Route::get('callback', [SocialiteAuthController::class, 'authenticate'])->name('socialite_callback');
});

// Checkout plan
Route::get('/checkout/{plan?}', CheckoutController::class)
    ->middleware(['auth', 'verified'])
    ->name('checkout');

// Cancel plan
Route::get('/checkout/{plan}/cancel', [CheckoutController::class, 'cancel'])
    ->middleware(['auth', 'verified'])
    ->name('cancel_subscription');

// Checkout callback URI
Route::get('/checkout/{plan}/success', [CheckoutController::class, 'success'])
    ->middleware(['auth', 'verified'])
    ->name('checkout_success');


require __DIR__.'/settings.php';
