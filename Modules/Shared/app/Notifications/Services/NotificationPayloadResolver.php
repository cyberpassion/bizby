<?php

namespace Modules\Shared\Notifications\Services;

use Modules\Shared\Notifications\Events\ActivityOccurred;

class NotificationPayloadResolver
{

	/**
     * Email Template
     */
	public function email(ActivityOccurred $event): array
	{
    	$email = config("activity-mails.{$event->activityKey}.email");

	    if (! $email) {
    	    return [
        	    'subject' => 'Notification',
            	'view'    => null,
            	'vars'    => [],
	        ];
    	}

	    return [
    	    'subject' => $email['subject'] ?? 'Notification',
        	'view'    => $email['view'],
        	'vars'    => $event->data ?? [],
	    ];
	}

    /**
     * SMS payload (India DLT compliant)
     */
    public function sms(ActivityOccurred $event): array
    {
        $sms = config("activity-mails.{$event->activityKey}.sms");

        if (! $sms) {
            return app()->isLocal()
                ? ['error' => "No SMS config for {$event->activityKey}"]
                : [];
        }

        return [
            'sender_id'   => config('sms.sender_id'),
            'entity_id'   => config('sms.entity_id'),
            'template_id' => $sms['template_id'],
            'message'     => $this->interpolate(
                $sms['message'],
                $event->data ?? []
            ),
        ];
    }

    /**
     * WhatsApp payload
     */
    public function whatsapp(ActivityOccurred $event): array
    {
        $wa = config("activity-mails.{$event->activityKey}.whatsapp");

        if (! $wa) {
            return [
                'template' => 'unknown',
                'params'   => [$event->activityKey],
            ];
        }

        return [
            'template' => $wa['template'],
            'params'   => collect($wa['params'] ?? [])
                ->map(fn ($key) => $event->data[$key] ?? '')
                ->values()
                ->all(),
        ];
    }

    /**
     * Replace {{placeholders}} with data
     */
    protected function interpolate(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = str_replace('{{'.$key.'}}', $value, $template);
        }

        return $template;
    }
}
