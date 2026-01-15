<?php

namespace Modules\Shared\Notifications\Channels;

class SmsChannel
{
    public static function send(string $to, string $message): void
    {
        // Integrate MSG91 / Twilio / AWS SNS here
    }
}
