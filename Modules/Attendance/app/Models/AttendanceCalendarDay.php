<?php
namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceCalendarDay extends TenantModel
{
	use HasFactory;
	
    protected $table = 'attendance_calendar_days';

    protected $fillable = [
        'tenant_id',
        'date',
        'day_type',
        'reason',
        'context',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
