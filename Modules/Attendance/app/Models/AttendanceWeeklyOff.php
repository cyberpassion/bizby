<?php
namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceWeeklyOff extends TenantModel
{
	use HasFactory;
	
    protected $table = 'attendance_weekly_offs';

    protected $fillable = [
        'tenant_id',
        'weekday',
        'context',
    ];
}
