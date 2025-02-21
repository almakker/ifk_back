<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelEventController;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/hotel-events', [HotelEventController::class, 'index']);
    Route::get('/hotel-events/types', [HotelEventController::class, 'types']);
    Route::get('/hotel-events/users', [HotelEventController::class, 'users']);
}); 