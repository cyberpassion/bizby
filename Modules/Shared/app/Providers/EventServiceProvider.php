<?php

namespace Modules\Shared\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\Shared\Notifications\Events\ActivityOccurred;
use Modules\Shared\Notifications\Listeners\SendActivityEmail;
use Modules\Shared\Notifications\Listeners\SendActivitySms;
use Modules\Shared\Notifications\Listeners\SendActivityWhatsapp;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
		ActivityOccurred::class => [
        	SendActivityEmail::class,
        	SendActivitySms::class,
        	SendActivityWhatsapp::class,
    	]
	];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
