<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Modules\Shared\Services\Schedules\TenantScheduleRunnerService;

/*
|--------------------------------------------------------------------------
| Artisan Commands
|--------------------------------------------------------------------------
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Scheduler (Tenant Schedules)
|--------------------------------------------------------------------------
*/

Schedule::call(function () {
    app(TenantScheduleRunnerService::class)->runDueSchedules();
})->everyMinute();
