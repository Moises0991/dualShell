<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

// manual authentication
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// redirect to Socialite
Route::get('/login-google', [UserController::class, 'redirectToGoogle'])->name('login-google');
Route::get('/login-facebook', [UserController::class, 'redirectToFacebook'])->name('login-facebook');
Route::get('/login-linkedin', [UserController::class, 'redirectToLinkedin'])->name('login-linkedin');
