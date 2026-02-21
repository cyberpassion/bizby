<?php
namespace Modules\Attendance\Services;

use Modules\Attendance\Models\AttendanceSchedule;
use Modules\Attendance\Models\AttendanceSession;

class ScheduleSessionRebuilder
{
    public function __construct(
        private ScheduleSessionGenerator $generator
    ) {}

    public function rebuild(AttendanceSchedule $schedule)
    {
        AttendanceSession::where('tenant_id', $schedule->tenant_id)
            ->where('attendance_schedule_id', $schedule->id)
            ->whereDate('session_date', '>=', today())
            ->get()
            ->each(function ($session) {

                if ($session->attendances()->exists()) {
                    return; // protect real data
                }

                $session->delete();
            });

        return $this->generator->generate($schedule);
    }
}
