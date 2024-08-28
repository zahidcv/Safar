<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DriverController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/test', [AuthController::class, 'test']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::post('/account_verify', [AuthController::class,'account_verify'])->name('verify');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/driver', [DriverController::class, 'show'])->name('driver.show');
    Route::post('/driver/update', [DriverController::class, 'update'])->name('driver.update');


    Route::post('/trip', [TripController::class, 'store'])->name('trip.store');
    Route::get('/trip/{trip}', [TripController::class,'show'])->name('trip.show');

    Route::post('trip/{trip}/accept', [TripController::class,'accept']);
    Route::post('trip/{trip}/start', [TripController::class, 'start']);
    Route::post('trip/{trip}/end', [TripController::class,'end']);
    Route::post('trip/{trip}/location', [TripController::class,'location']);



    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});


