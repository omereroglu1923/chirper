<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;

// Ana sayfa: herkese açık, giriş şartı yok
Route::get('/', [ChirpController::class, 'index']);

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login'); // Laravel'in auth middleware'i bu ismi otomatik arıyor

Route::post('/login', Login::class)->middleware('guest');

Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

// guest middleware: sadece giriş yapmamış kişiler görebilir
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

// auth middleware: sadece giriş yapmış kişiler erişebilir (grup halinde)
Route::middleware('auth')->group(function () {
    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
});
