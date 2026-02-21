<?php
namespace Modules\Attendance\Services;

use Carbon\Carbon;
use Modules\Attendance\Models\AttendanceWeeklyOff;
use Modules\Attendance\Models\AttendanceHoliday;
use Modules\Attendance\Models\AttendanceCalendarDay;

class WorkingDayService
{
    public function isWorkingDay(int $tenantId, Carbon $date, ?string $context = null): bool
    {
        // 1. Overrides (highest priority)
        $override = AttendanceCalendarDay::where([
            'tenant_id' => $tenantId,
            'date'      => $date->toDateString(),
            'context'   => $context,
        ])->first();

        if ($override) {
            return in_array($override->day_type, ['working', 'special_working']);
        }

        // 2. Holidays
        if (AttendanceHoliday::where('tenant_id', $tenantId)
            ->whereDate('date', $date)
            ->exists()) {
            return false;
        }

        // 3. Weekly offs
        if (AttendanceWeeklyOff::where('tenant_id', $tenantId)
            ->where('weekday', $date->dayOfWeekIso)
            ->exists()) {
            return false;
        }

        return true;
    }

}
