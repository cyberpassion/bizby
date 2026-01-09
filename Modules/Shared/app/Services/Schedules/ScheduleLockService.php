<?php

namespace Modules\Shared\Services\Schedules;

use Carbon\Carbon;
use Modules\Shared\Models\Schedules\ScheduleLock;

class ScheduleLockService
{
    /**
     * Try to acquire lock
     */
    public static function acquire(
        int $scheduleId,
        int $tenantId,
        int $ttlSeconds = 300
    ): bool {
        $now = now();

        return ScheduleLock::query()
            ->where('schedule_id', $scheduleId)
            ->where('tenant_id', $tenantId)
            ->where('locked_until', '>', $now)
            ->doesntExist()
            && ScheduleLock::updateOrCreate(
                [
                    'schedule_id' => $scheduleId,
                    'tenant_id'   => $tenantId,
                ],
                [
                    'locked_until' => $now->addSeconds($ttlSeconds),
                ]
            );
    }

    /**
     * Release lock
     */
    public static function release(int $scheduleId, int $tenantId): void
    {
        ScheduleLock::where('schedule_id', $scheduleId)
            ->where('tenant_id', $tenantId)
            ->delete();
    }
}
