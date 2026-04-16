<?php

namespace Modules\Attendance\Services;

use Carbon\Carbon;

use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Models\AttendanceSession;
use Modules\Attendance\Models\AttendanceWeeklyOff;
use Modules\Attendance\Models\AttendanceCalendarDay;
use Modules\Attendance\Models\AttendanceHoliday;
use Modules\Attendance\Models\AttendanceSchedule;
use Modules\Attendance\Services\WorkingDayService;
use Illuminate\Validation\ValidationException;

class AttendanceService
{

	public function __construct(
        private WorkingDayService $workingDayService
    ) {}

    public function createSession(array $data, $takenBy)
	{
    	$batchIds = $data['batch_ids'] ?? [];
	    unset($data['batch_ids']);

	    $session = AttendanceSession::create([
    	    ...$data,
	        'tenant_id' => tenant()->id,
    	    'taken_by_id' => $takenBy->id,
        	'taken_by_type' => get_class($takenBy),
	    ]);

	    if (!empty($batchIds)) {
    	    $session->batches()->sync($batchIds);
    	}

	    return $session->load('batches');
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

	public function createWeeklyOff(array $data)
	{
    	return AttendanceWeeklyOff::create($data);
	}

	public function createHoliday(array $data)
	{
    	return AttendanceHoliday::create($data);
	}

	public function createCalendarOverride(array $data)
	{
    	return AttendanceCalendarDay::updateOrCreate(
	        [
    	        'tenant_id' => $data['tenant_id'],
        	    'date'      => $data['date'],
            	'context'   => $data['context'] ?? null,
	        ],
    	    $data
    	);
	}

	public function updateCalendarOverride(AttendanceCalendarDay $override, array $data)
	{
	    /*
    	|--------------------------------------------------------------------------
    	| Validate allowed fields ONLY
    	|--------------------------------------------------------------------------
    	*/

	    $payload = validator($data, [
    	    'date'     => 'nullable|date',
        	'day_type' => 'nullable|string',
        	'reason'   => 'nullable|string',
	        'context'  => 'nullable|string',
    	])->validate();

	    /*
    	|--------------------------------------------------------------------------
	    | Prevent duplicate override collisions
    	|--------------------------------------------------------------------------
    	*/

	    if (isset($payload['date']) || array_key_exists('context', $payload)) {

    	    $date    = $payload['date'] ?? $override->date->toDateString();
        	$context = $payload['context'] ?? $override->context;

	        $exists = AttendanceCalendarDay::where('tenant_id', $override->tenant_id)
    	        ->where('date', $date)
        	    ->where('context', $context)
            	->where('id', '!=', $override->id)
            	->exists();

	        if ($exists) {
    	        abort(422, 'Override already exists for selected date/context.');
        	}
    	}

	    /*
    	|--------------------------------------------------------------------------
	    | Apply Update
    	|--------------------------------------------------------------------------
	    */

	    $override->update($payload);

	    return $override->fresh();
	}

	public function generateSessions(AttendanceSchedule $schedule, $start = null, $end = null)
	{
    	$created = [];

	    $startDate = $start ? Carbon::parse($start) : today();

	    $endDate = $end ? Carbon::parse($end) : ($schedule->ends_on ?? today()->addMonths(6));

	    /*
    	|--------------------------------------------------------------------------
	    | Clamp to schedule boundaries
    	|--------------------------------------------------------------------------
    	*/

	    $startDate = $startDate->max($schedule->starts_from);

    	if ($schedule->ends_on) {
        	$endDate = $endDate->min($schedule->ends_on);
    	}

	    /*
    	|--------------------------------------------------------------------------
	    | Load schedule batches once (avoid N+1 queries)
    	|--------------------------------------------------------------------------
	    */

	    $schedule->loadMissing('batches');
    	$batchIds = $schedule->batches->pluck('id')->toArray();

	    /*
    	|--------------------------------------------------------------------------
	    | Generate sessions
    	|--------------------------------------------------------------------------
    	*/

	    for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {

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

	        $session = AttendanceSession::firstOrCreate(
    	        [
        	        'tenant_id' => $schedule->tenant_id,
            	    'attendance_schedule_id' => $schedule->id,
                	'type' => $schedule->type,
	                'session_date' => $date->toDateString(),
    	            'start_time' => $schedule->start_time,
        	        'end_time' => $schedule->end_time,
            	    'context' => $schedule->context,
            	],
            	[
                	'mode' => $schedule->mode ?? 'system',
	                'reference' => $schedule->reference,
    	        ]
        	);

	        /*
    	    |--------------------------------------------------------------------------
        	| Copy schedule batches → session batches
        	|--------------------------------------------------------------------------
        	*/

	        if (!empty($batchIds)) {
    	        $session->batches()->syncWithoutDetaching($batchIds);
        	}

	        $created[] = $session;
    	}

	    return $created;
	}

	public function rebuildFutureSessions( AttendanceSchedule $schedule, $start = null, $end = null )
	{
    	$startDate = $start ? Carbon::parse($start) : today();

	    $endDate = $end ? Carbon::parse($end) : ($schedule->ends_on ?? today()->addMonths(6));

	    // NEVER allow past rebuild
    	$startDate = $startDate->max(today());

	    AttendanceSession::where('tenant_id', $schedule->tenant_id)
    	    ->where('attendance_schedule_id', $schedule->id)
        	->whereBetween('session_date', [$startDate, $endDate])
        	->get()
        	->each(function ($session) {

            if ($session->attendances()->exists()) {
                return;
            }

            $session->delete();
        });

    	return $this->generateSessions($schedule, $startDate, $endDate);
	}

	public function createSchedule(array $data)
	{

	    $batchIds = $data['batch_ids'] ?? [];
    	unset($data['batch_ids']);

	    /*
	    |--------------------------------------------------------------------------
    	| Validate Business Rules
    	|--------------------------------------------------------------------------
	    */

	    $payload = validator($data, [
    	    'type'        => 'required|string',
        	'weekdays'    => 'required|array|min:1',
	        'weekdays.*'  => 'integer|min:1|max:7',
    	    'start_time'  => 'required',
        	'end_time'    => 'required',
	        'starts_from' => 'required|date',
    	    'ends_on'     => 'nullable|date|after_or_equal:starts_from',
        	'context'     => 'nullable|string',
        	'reference'   => 'nullable|string',
        	'mode'        => 'nullable|string',
	    ])->validate();

	    if ($payload['start_time'] >= $payload['end_time']) {
    	    throw ValidationException::withMessages([
        	    'end_time' => 'End time must be after start time.'
	        ]);
    	}

	    $exists = AttendanceSchedule::where('tenant_id', tenant()->id)
    	    ->where('type', $payload['type'])
        	->where('context', $payload['context'] ?? null)
	        ->where('start_time', $payload['start_time'])
    	    ->where('end_time', $payload['end_time'])
        	->where('starts_from', $payload['starts_from'])
        	->where('ends_on', $payload['ends_on'] ?? null)
        	->exists();

	    if ($exists) {
    	    throw ValidationException::withMessages([
        	    'type' => 'An identical schedule already exists.'
	        ]);
    	}

	    /*
    	|--------------------------------------------------------------------------
	    | Create Schedule
    	|--------------------------------------------------------------------------
    	*/

	    $schedule = AttendanceSchedule::create([
    	    ...$payload,
        	'tenant_id' => tenant()->id,
        	'is_active' => true,
	    ]);

	    /*
    	|--------------------------------------------------------------------------
	    | Attach Batches
    	|--------------------------------------------------------------------------
    	*/

	    if (!empty($batchIds)) {
    	    $schedule->batches()->sync($batchIds);
    	}

	    return $schedule->load('batches');

	}

}
