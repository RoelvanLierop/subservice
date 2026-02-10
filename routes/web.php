<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// At least group the URI's;
Route::prefix('auth')->group( function() {
    Route::get('redirect', function () {
        return Socialite::driver('github')->redirect();
    });
    Route::get('callback', function () {
        return Socialite::driver('github')->user();
    });
});



require __DIR__.'/settings.php';
