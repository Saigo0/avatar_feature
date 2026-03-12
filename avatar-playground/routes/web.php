<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('home');
});

Route::get('avatar', [AvatarController::class, 'edit']);
Route::post('avatar', [AvatarController::class, 'update']);

Route::post('login', [LoginController::class, 'login']);
