<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\AdminControlController;
use App\Http\Controllers\MetaInformationController;

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

    Route::controller(DonorController::class)
        ->group(function (){
             Route::get('/', 'index')->name('all');
             Route::get('{id}/information', 'showDonorInformation')->name('information');
        });

    Route::controller(DonorController::class)
        ->middleware(['auth:sanctum', 'role:donor'])
        ->name('user.')
        ->group(function (){
            Route::put('profile', 'update')->name('profile.update');
            Route::get('profile', 'profile')->name('profile.show');
        });

    Route::controller(AdminControlController::class)
        ->middleware(['auth:sanctum', 'role:admin'])
        ->name('admin.')
        ->group(function (){
            Route::put('change-status/{id}', 'changeUserStatus')->name('change-status');
        });
});

Route::controller(MetaInformationController::class)
    ->prefix('meta')
    ->name('meta.')
    ->group(function (){
        Route::get('information', 'index')->name('information');
    });
