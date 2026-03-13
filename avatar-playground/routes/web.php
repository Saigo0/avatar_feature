<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register-index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-index');

Route::post('/register', [AuthController::class, 'register'])->name('auth-register');
Route::post('/login', [AuthController::class, 'login'])->name('auth-login');

Route::get('/avatar', [AvatarController::class, 'edit'])->name('avatar-edit');
Route::post('/avatar', [AvatarController::class, 'update'])->name('avatar-update');
