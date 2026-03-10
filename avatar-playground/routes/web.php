<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('avatar', [AvatarController::class, 'edit']);
Route::post('avatar', [AvatarController::class, 'update']);
