<?php
namespace Modules\Attendance\Services;

use Carbon\Carbon;
use Modules\Attendance\Models\AttendanceSession;
use Modules\Attendance\Models\AttendanceSchedule;

class ScheduleSessionGenerator
{
    public function __construct(private WorkingDayService $workingDayService) {}

    public function generate(AttendanceSchedule $schedule)
    {
        $created = [];

        $start = $schedule->starts_from->copy();
        $end   = $schedule->ends_on ?? now()->addMonths(6);

        for ($date = $start; $date->lte($end); $date->addDay()) {

            if (!in_array($date->dayOfWeekIso, $schedule->weekdays)) {
                continue;
            }

            if (!$this->workingDayService->isWorkingDay(
                $schedule->tenant_id,
                $date,
                $schedule->context
            )) {
                continue;
            }

            $created[] = AttendanceSession::firstOrCreate([
                'tenant_id' => $schedule->tenant_id,
                'attendance_schedule_id' => $schedule->id,
                'type' => $schedule->type,
                'session_date' => $date->toDateString(),
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time,
                'context' => $schedule->context,
            ]);
        }

        return $created;
    }
}
