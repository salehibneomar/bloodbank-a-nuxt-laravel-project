<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AdminControlController;

require __DIR__.'/auth.php';


Route::controller(AdminControlController::class)
->prefix('admin')
->name('admin.')
->middleware(['auth:sanctum', 'role:admin'])
->group(function (){
    Route::get('dashboard', 'getDashboardData')->name('dashboard');
});

Route::prefix('donors')
->name('donors.')
->group(function (){

    Route::get('/', [DonorController::class, 'index'])
        ->name('all');

    Route::controller(DonorController::class)
        ->middleware(['auth:sanctum', 'role:donor'])
        ->name('user.')
        ->group(function (){
            Route::put('profile', 'update')
                ->name('profile.update');
        });

    Route::controller(AdminControlController::class)
        ->middleware(['auth:sanctum', 'role:admin'])
        ->name('admin.')
        ->group(function (){
            Route::put('change-status/{id}', 'changeUserStatus')
                ->name('change-status');
        });
});
