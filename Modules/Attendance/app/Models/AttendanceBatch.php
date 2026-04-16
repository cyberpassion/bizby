<?php

namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceBatch extends TenantModel
{
    use HasFactory;

    protected $table = 'attendance_batches';

    protected $fillable = [
        'tenant_id',
        'name',
        'code',
        'academic_year',
        'start_date',
        'end_date',
        'status'
    ];

    public function participants()
    {
        return $this->hasMany(AttendanceBatchParticipant::class, 'batch_id');
    }

	public function schedules()
	{
    	return $this->belongsToMany(
	        AttendanceSchedule::class,
    	    'attendance_schedule_batches',
        	'batch_id',
        	'attendance_schedule_id'
	    );
	}

	public function sessions()
	{
    	return $this->belongsToMany(
	        AttendanceSession::class,
    	    'attendance_session_batches',
        	'batch_id',
        	'attendance_session_id'
	    );
	}

}