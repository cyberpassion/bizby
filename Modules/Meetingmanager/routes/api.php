<?php

use Illuminate\Support\Facades\Route;
use Modules\Meetingmanager\Http\Controllers\MeetingmanagerApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'meetingmanagers',
            MeetingmanagerApiController::class
        )->names('meetingmanagers');
    });
