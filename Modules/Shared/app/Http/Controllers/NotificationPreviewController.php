<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shared\Notifications\Mailables\ActivityMail;

class NotificationPreviewController extends Controller
{
    public function email(string $activityKey)
    {
        abort_unless(app()->isLocal(), 403);

        $config = config("notifications.$activityKey");
        abort_if(! $config, 404, 'Activity mail not found');

        $emailConfig = $config['email'] ?? null;
        abort_if(! $emailConfig, 404, 'Email config not found for this activity');

        $data = $config['preview'] ?? [];

        return (new ActivityMail(
            subjectLine: $emailConfig['subject'] ?? 'Notification',
            templateView: $emailConfig['view'] ?? null,
            variables: $data
        ))->render();
    }
}
