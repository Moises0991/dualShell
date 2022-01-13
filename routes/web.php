<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalAuthController;

// main views 
// Route::get('/login', function() { return view('app'); })->middleware('guest')->name('login');
// Route::get('/', function() { return view('home'); })->middleware('auth')->name('home');
Route::get('/login', function() { return view('app'); })->name('login');
Route::get('/', function() { return view('home'); })->name('home');

// callbacks from Socialite
Route::get('/google-callback', [ExternalAuthController::class, 'callbackFromGoogle'])->name('google-callback');
Route::get('/facebook-callback', [ExternalAuthController::class, 'callbackFromGoogle'])->name('facebook-callback');
Route::get('/linkedin-callback', [ExternalAuthController::class, 'callbackFromLinkedin'])->name('linkedin-callback');