<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::post('/resources', [ResourceController::class, 'store']);
Route::get('/resources', [ResourceController::class, 'index']);

Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/resources/{id}/bookings', [BookingController::class, 'getByResource']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
