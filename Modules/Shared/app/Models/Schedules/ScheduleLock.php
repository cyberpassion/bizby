<?php

namespace Modules\Shared\Models\Schedules;

use Illuminate\Database\Eloquent\Model;

class ScheduleLock extends Model
{
    protected $fillable = ['schedule_id', 'tenant_id', 'locked_until'];

    public static function acquire(Schedule $schedule, int $seconds = 300): bool
    {
        try {
            static::create([
                'schedule_id' => $schedule->id,
                'tenant_id'   => $schedule->tenant_id,
                'locked_until'=> now()->addSeconds($seconds),
            ]);
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public static function release(Schedule $schedule): void
    {
        static::where('schedule_id', $schedule->id)
            ->where('tenant_id', $schedule->tenant_id)
            ->delete();
    }
}
