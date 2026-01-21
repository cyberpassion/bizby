<?php

namespace Modules\Attendance\Services;

use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Models\AttendanceSession;

class AttendanceService
{
    public function createSession(array $data, $takenBy)
	{
    	return AttendanceSession::create([
    	    ...$data,
	        'tenant_id' => tenant()->id,
        	'taken_by_id' => $takenBy->id,
        	'taken_by_type' => get_class($takenBy),
	    ]);
	}

    public function markAttendance(AttendanceSession $session, array $data)
	{
    	return $session->attendances()->updateOrCreate(
	        [
    	        'tenant_id' => tenant()->id,
        	    'entity_id' => $data['entity_id'],
            	'entity_type' => $data['entity_type'],
	        ],
    	    [
        	    'attendance_status' => $data['attendance_status'],
            	'in_time'  => $data['in_time'] ?? null,
	            'out_time' => $data['out_time'] ?? null,
    	        'source'   => $data['source'] ?? 'admin',
        	    'code'     => $data['code'] ?? null,
            	'reason'   => $data['reason'] ?? null,
	        ]
    	);
	}

    public function bulkMark(AttendanceSession $session, array $items)
	{
    	$rows = collect($items)->map(fn ($item) => [
	        'tenant_id' => tenant()->id,
    	    'attendance_session_id' => $session->id,
        	'entity_id' => $item['entity_id'],
	        'entity_type' => $item['entity_type'],
    	    'attendance_status' => $item['attendance_status'],
        	'created_at' => now(),
        	'updated_at' => now(),
	    ])->toArray();

	    Attendance::upsert(
    	    $rows,
        	['tenant_id', 'attendance_session_id', 'entity_id', 'entity_type'],
        	['attendance_status', 'updated_at']
    	);
	}

    public function punch(Attendance $attendance, string $type, string $time)
    {
        if ($type === 'in') {
            $attendance->update(['in_time' => $time]);
        } else {
            $attendance->update(['out_time' => $time]);
        }

        return $attendance;
    }

    public function selfPunch($user, string $type, string $time)
	{
    	$session = AttendanceSession::firstOrCreate(
	        [
    	        'tenant_id' => tenant()->id,
        	    'type' => 'shift',
            	'session_date' => now()->toDateString(),
	        ],
    	    ['mode' => 'self']
    	);

	    return $this->markAttendance($session, [
    	    'entity_id' => $user->id,
        	'entity_type' => get_class($user),
	        'attendance_status' => 'present',
    	    'source' => 'self',
        	$type . '_time' => $time,
	    ]);
	}

}
