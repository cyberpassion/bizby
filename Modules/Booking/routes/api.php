<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingVenueApiController;
use Modules\Booking\Http\Controllers\BookingUnitApiController;
use Modules\Booking\Http\Controllers\BookingApiController;

Route::prefix('v1')->group(function () {

    Route::prefix('booking')->group(function () {

        /* -----------------------------
         | Venues
         |-----------------------------*/
        Route::apiResource('venues', BookingVenueApiController::class);

        /* -----------------------------
         | Bookable Units
         |-----------------------------*/
        Route::get(
            'venues/{venue}/units',
            [BookingUnitApiController::class, 'index']
        );

        Route::post(
            'venues/{venue}/units',
            [BookingUnitApiController::class, 'store']
        );

        Route::put(
            'venues/{venue}/units/{unit}',
            [BookingUnitApiController::class, 'update']
        );

        Route::delete(
            'venues/{venue}/units/{unit}',
            [BookingUnitApiController::class, 'destroy']
        );

        /* -----------------------------
         | Bookings
         |-----------------------------*/
        Route::get(
            'venues/{venue}/bookings',
            [BookingApiController::class, 'index']
        );

        Route::post(
            'bookings',
            [BookingApiController::class, 'store']
        );

        Route::post(
            'bookings/{booking}/cancel',
            [BookingApiController::class, 'cancel']
        );
    });
});
