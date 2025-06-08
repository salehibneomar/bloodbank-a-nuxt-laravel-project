<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

require __DIR__.'/auth.php';

Route::controller(TodoController::class)
    ->prefix('todos')
    ->name('todos.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::get('donors', [\App\Http\Controllers\DonorController::class, 'index'])
    ->name('donors.index');


Route::put('donors/profile', [\App\Http\Controllers\DonorController::class, 'update'])
->name('donors.profile.update')
->middleware('auth:sanctum');
