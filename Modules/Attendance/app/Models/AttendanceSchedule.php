<?php
namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceSchedule extends TenantModel
{
	use HasFactory;
	
    protected $table = 'attendance_schedules';

    protected $fillable = [
        'tenant_id',
        'type',
        'weekdays',
        'start_time',
        'end_time',
        'starts_from',
        'ends_on',
        'context',
        'reference',
        'mode',
        'is_active',
    ];

    protected $casts = [
        'weekdays'    => 'array',
        'starts_from' => 'date:Y-m-d',
        'ends_on'     => 'date:Y-m-d',
        'is_active'   => 'boolean',
    ];

	public function batches()
	{
    	return $this->belongsToMany(
	        AttendanceBatch::class,
    	    'attendance_schedule_batches',
        	'attendance_schedule_id',
        	'batch_id'
    	);
	}

}
