<?php

use Illuminate\Support\Facades\Route;

use Modules\Shared\Http\Controllers\NotificationPreviewController;
use Modules\Shared\Notifications\Events\ActivityOccurred;
use Modules\Shared\Notifications\Services\NotificationPayloadResolver;

if (app()->isLocal()) {
    Route::get(
        '/_preview/email/{activityKey}',
        [NotificationPreviewController::class, 'email']
    );
}

Route::get('/_preview/sms/{activityKey}', function ($activityKey) {
    abort_unless(app()->isLocal(), 403);

    $config = config("notifications.$activityKey");
    abort_if(! $config, 404);

    $event = new ActivityOccurred(
        $activityKey,
        1,
        'test@example.com',
        '9999999999',
        $config['preview'] ?? []
    );

    $message = app(NotificationPayloadResolver::class)->sms($event);

    abort_if(empty($message), 500, 'SMS preview is empty');

    return response()
        ->json([
            'channel'      => 'sms',
            'activity_key' => $activityKey,
            'payload'      => [
                'message' => $message,
            ],
            'preview_data' => $event->data,
        ])
        ->setEncodingOptions(JSON_PRETTY_PRINT);
});

Route::get('/_preview/whatsapp/{activityKey}', function ($activityKey) {
    abort_unless(app()->isLocal(), 403);

    $config = config("notifications.$activityKey");
    abort_if(! $config, 404);

    $event = new ActivityOccurred(
        $activityKey,
        1,
        'test@example.com',
        '9999999999',
        $config['preview'] ?? []
    );

    $payload = app(NotificationPayloadResolver::class)->whatsapp($event);

    abort_if(empty($payload), 500, 'WhatsApp preview is empty');

    return response()
        ->json([
            'channel'      => 'whatsapp',
            'activity_key' => $activityKey,
            'payload'      => $payload,
            'preview_data' => $event->data,
        ])
        ->setEncodingOptions(JSON_PRETTY_PRINT);
});
