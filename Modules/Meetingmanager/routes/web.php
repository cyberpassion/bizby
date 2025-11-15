<?php

use Illuminate\Support\Facades\Route;
use Modules\Meetingmanager\Http\Controllers\MeetingmanagerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('meetingmanagers', MeetingmanagerController::class)->names('meetingmanager');
	// Custom Routes
    Route::prefix('meetingmanager')->name('meetingmanager.')->group(function () {
        Route::get('home', [MeetingmanagerController::class, 'home'])->name('home');
        Route::get('list', [MeetingmanagerController::class, 'list'])->name('list');
        Route::get('report', [MeetingmanagerController::class, 'report'])->name('report');
        Route::get('settings', [MeetingmanagerController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [MeetingmanagerController::class, 'view'])->name('view');
        Route::get('{id}/edit', [MeetingmanagerController::class, 'edit'])->name('edit');
    });
});
