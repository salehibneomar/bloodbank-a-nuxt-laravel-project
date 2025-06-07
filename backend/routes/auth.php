<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonorController;


Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::controller(AuthController::class)
            ->group(function () {
                Route::post('login', 'login')->name('login');
                Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
            });
        Route::controller(DonorController::class)
            ->prefix('donors')
            ->name('donors.')
            ->group(function () {
                Route::post('register', 'register')->name('register');
            });
    });
