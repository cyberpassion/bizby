<?php

use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingApiController;
use Modules\Listing\Http\Controllers\ListingTrackingApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('listings')->name('listings.')->group(function () {

            /* ======================================================
             | DASHBOARD
             ====================================================== */
            Route::get('stats', [ListingApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [ListingApiController::class, 'graphs'])->name('graphs');

            /* ======================================================
             | TRACKING
             ====================================================== */
            Route::post('{listing}/track', [ListingTrackingApiController::class, 'track'])->name('track');

            /* ======================================================
             | QUICK ACTION TRACKING
             ====================================================== */
            Route::post('{listing}/contact-click', [ListingTrackingApiController::class, 'contactClick'])->name('contact-click');
            Route::post('{listing}/website-click', [ListingTrackingApiController::class, 'websiteClick'])->name('website-click');
            Route::post('{listing}/whatsapp-click', [ListingTrackingApiController::class, 'whatsappClick'])->name('whatsapp-click');

            /* ======================================================
             | OPTIONAL (FUTURE)
             ====================================================== */
            // Route::get('{listing}/events', [ListingTrackingApiController::class, 'events'])->name('events');
            // Route::get('{listing}/stats', [ListingTrackingApiController::class, 'stats'])->name('listing-stats');
        });

        /* ======================================================
         | CRUD (KEEP SEPARATE LIKE INVENTORY)
         ====================================================== */
        Route::apiResource(
            'listings',
            ListingApiController::class
        )->names('listings');
    });