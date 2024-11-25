<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\KlarnaLoginController::class, 'login']);
Route::get('/login/klarna', [App\Http\Controllers\KlarnaLoginController::class, 'redirectToKlarna']);
Route::get('/login/callback', [App\Http\Controllers\KlarnaLoginController::class, 'handleCallback']);
