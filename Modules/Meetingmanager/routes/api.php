<?php

use Illuminate\Support\Facades\Route;
use Modules\Meetingmanager\Http\Controllers\MeetingmanagerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('meetingmanagers', MeetingmanagerController::class)->names('meetingmanager');
});
