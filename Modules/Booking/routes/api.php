<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingVenueApiController;
use Modules\Booking\Http\Controllers\BookableUnitApiController;
use Modules\Booking\Http\Controllers\BookingApiController;
use Modules\Booking\Http\Controllers\BookingUnitPricingApiController;

Route::prefix('v1')->group(function () {
    Route::prefix('booking')->group(function () {

        // Units
        Route::get('/venues/{venue}/units', [BookableUnitApiController::class, 'index']);
        Route::post('/venues/{venue}/units', [BookableUnitApiController::class, 'store']);
        Route::get('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'show']);
        Route::put('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'update']);
        Route::delete('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'destroy']);

        // Unit pricing
        Route::get('/units/{unit}/pricing', [BookingUnitPricingApiController::class, 'index']);
        Route::post('/units/{unit}/pricing', [BookingUnitPricingApiController::class, 'store']);
        Route::put('/units/{unit}/pricing/{pricing}', [BookingUnitPricingApiController::class, 'update']);
        Route::delete('/units/{unit}/pricing/{pricing}', [BookingUnitPricingApiController::class, 'destroy']);

        // Bookings
        Route::get('/venues/{venue}/bookings', [BookingApiController::class, 'index']);
        Route::post('/bookings', [BookingApiController::class, 'store']);
        Route::post('/bookings/preview-fee', [BookingApiController::class, 'previewFee']);
        Route::post('/bookings/{booking}/cancel', [BookingApiController::class, 'cancel']);

        // Venues
        Route::apiResource('venues', BookingVenueApiController::class);
    });
});

