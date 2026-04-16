<?php
namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceScheduleBatch extends TenantModel
{
	use HasFactory;
	
    protected $table = 'attendance_schedule_batches';

    protected $fillable = [
        'attendance_schedule_id',
        'batch_id'
    ];

    public $timestamps = false;

    public function schedule()
    {
        return $this->belongsTo(AttendanceSchedule::class, 'attendance_schedule_id');
    }

    public function batch()
    {
        return $this->belongsTo(AttendanceBatch::class, 'batch_id');
    }
}
