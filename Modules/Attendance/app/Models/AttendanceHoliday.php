<?php
namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceHoliday extends TenantModel
{
	use HasFactory;
	
    protected $table = 'attendance_holidays';

    protected $fillable = [
        'tenant_id',
        'date',
        'name',
        'context',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
