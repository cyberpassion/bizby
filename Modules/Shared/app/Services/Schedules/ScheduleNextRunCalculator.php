<?php

namespace Modules\Shared\Services\Schedules;

use Carbon\Carbon;
use Cron\CronExpression;
use Modules\Shared\Models\Schedules\Schedule;

class ScheduleNextRunCalculator
{
    public static function calculate(Schedule $schedule, ?Carbon $from = null): Carbon
    {
        $from = $from
            ? $from->copy()
            : now($schedule->timezone);

        return match ($schedule->frequency) {
            'daily'   => self::daily($schedule, $from),
            'weekly'  => self::weekly($schedule, $from),
            'monthly' => self::monthly($schedule, $from),
            'cron'    => self::cron($schedule, $from),
            default   => throw new \RuntimeException('Invalid schedule frequency'),
        };
    }

    protected static function daily(Schedule $schedule, Carbon $from): Carbon
    {
        $runAt = Carbon::createFromTimeString(
            $schedule->run_at->format('H:i'),
            $schedule->timezone
        );

        return $from->copy()->addDay()->setTimeFrom($runAt);
    }

    protected static function weekly(Schedule $schedule, Carbon $from): Carbon
    {
        $days = $schedule->meta['days'] ?? []; // ['mon','fri']
        if (empty($days)) {
            throw new \RuntimeException('Weekly schedule requires meta.days');
        }

        for ($i = 1; $i <= 7; $i++) {
            $candidate = $from->copy()->addDays($i);

            if (in_array(strtolower($candidate->format('D')), $days)) {
                return $candidate->setTimeFrom($schedule->run_at);
            }
        }

        throw new \RuntimeException('Unable to calculate weekly next run');
    }

    protected static function monthly(Schedule $schedule, Carbon $from): Carbon
    {
        return $from->copy()
            ->addMonth()
            ->setDay($from->day)
            ->setTimeFrom($schedule->run_at);
    }

    protected static function cron(Schedule $schedule, Carbon $from): Carbon
    {
        $cron = new CronExpression($schedule->cron_expression);
        return Carbon::instance(
            $cron->getNextRunDate($from, 0, true)
        );
    }
}
