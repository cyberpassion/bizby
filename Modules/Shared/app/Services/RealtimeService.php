<?php

namespace Modules\Shared\Services;

use Modules\Shared\Notifications\Events\RealtimeEvent;

class RealtimeService
{
    public static function emit(
        string $channel,
        string $event,
        array $data = []
    ): void {
        event(
            new RealtimeEvent(
                channelName: $channel,
                eventName: $event,
                payload: $data
            )
        );
    }

    public static function user(
        int|string $userId,
        string $event,
        array $data = []
    ): void {
        self::emit(
            "user.{$userId}",
            $event,
            $data
        );
    }

    public static function organization(
        int|string $organizationId,
        string $event,
        array $data = []
    ): void {
        self::emit(
            "organization.{$organizationId}",
            $event,
            $data
        );
    }

    public static function module(
        string $module,
        string $event,
        array $data = []
    ): void {
        self::emit(
            "module.{$module}",
            $event,
            $data
        );
    }
}
