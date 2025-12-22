<?php

use Illuminate\Support\Facades\Route;

use Modules\Booking\Http\Controllers\VenueApiController;
use Modules\Booking\Http\Controllers\BookingUnitApiController;
use Modules\Booking\Http\Controllers\BookingApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bookings', BookingController::class)->names('booking');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
	Route::prefix('booking')->group(function () {

		// Venues
    	Route::apiResource('/venues', VenueApiController::class)->names('venues');

		// Units
	    Route::get('/venues/{venue}/units', [BookingUnitApiController::class, 'index']);
    	Route::post('/venues/{venue}/units', [BookingUnitApiController::class, 'store']);

	    // Bookings
	    Route::get('/venues/{venue}/bookings', [BookingApiController::class, 'index']);
    	Route::post('/bookings', [BookingApiController::class, 'store']);
    	Route::post('/bookings/{booking}/cancel', [BookingApiController::class, 'cancel']);

	});
});
