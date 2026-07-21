<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

Route::get('/', [ChirpController::class, 'index']);
Route::post('/chirps', [ChirpController::class, 'store']);
// {chirp} = route model binding: Laravel otomatik olarak doğru Chirp nesnesini bulur
Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
