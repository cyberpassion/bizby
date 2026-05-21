<?php

use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingApiController;
use Modules\Listing\Http\Controllers\ListingPageBlockApiController;
use Modules\Listing\Http\Controllers\ListingTrackingApiController;
use Modules\Listing\Http\Controllers\ListingUploadApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        /* ======================================================
         | LISTINGS BLOCKS
         ====================================================== */
        Route::post('listings/{listingId}/page-blocks', [ListingPageBlockApiController::class, 'store']);
        Route::put('listings/{listingId}/page-blocks/{id}', [ListingPageBlockApiController::class, 'update']);
        Route::get('listings/{listingId}/page-blocks', [ListingPageBlockApiController::class, 'index']);
        Route::get('listings/{listingId}/page-blocks/{id}', [ListingPageBlockApiController::class, 'show']);
        Route::delete('listings/{listingId}/page-blocks/{id}', [ListingPageBlockApiController::class, 'destroy']);
        Route::post(
            'listings/{listingId}/page-blocks/reorder',
            [ListingPageBlockApiController::class, 'reorder']
        );

        /*
        |--------------------------------------------------------------------------
        | DOCUMENT UPLOAD
        |--------------------------------------------------------------------------
        */

        // Upload uploads for listing
        Route::post('listings/{id}/uploads', [ListingUploadApiController::class, 'upload'])
            ->name('listings.uploads');

        // Upload uploads for listing
        Route::get('listings/{id}/uploads', [ListingUploadApiController::class, 'getUploads']);

        /* ======================================================
         | LISTINGS CRUD
         ====================================================== */
        Route::apiResource('listings', ListingApiController::class)
            ->names('listings');

        /* ======================================================
         | STATS & GRAPHS (already supported by SharedApiController)
         ====================================================== */
        Route::get('listings/stats', [ListingApiController::class, 'stats'])
            ->name('listings.stats');

        Route::get('listings/graphs', [ListingApiController::class, 'graphs'])
            ->name('listings.graphs');

        /* ======================================================
         | TRACKING EVENTS
         ====================================================== */
        Route::post('listings/{id}/track', [ListingTrackingApiController::class, 'track'])
            ->name('listings.track');

        /* ======================================================
         | OPTIONAL: QUICK ACTION TRACKING
         ====================================================== */
        Route::post('listings/{id}/contact-click', [ListingTrackingApiController::class, 'contactClick']);
        Route::post('listings/{id}/website-click', [ListingTrackingApiController::class, 'websiteClick']);
        Route::post('listings/{id}/whatsapp-click', [ListingTrackingApiController::class, 'whatsappClick']);
    });

/*
|--------------------------------------------------------------------------
| PUBLIC LISTING ROUTES (NO AUTH)
|--------------------------------------------------------------------------
*/
Route::prefix('v1/public')->group(function () {

    // Public single listing
    Route::get('listings/{id}', [ListingApiController::class, 'showPublic'])
        ->name('listings.public.show');

});
