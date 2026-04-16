<?php
namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceSessionBatch extends TenantModel
{
	use HasFactory;
	
    protected $table = 'attendance_session_batches';

    protected $fillable = [
        'attendance_session_id',
        'batch_id'
    ];

    public $timestamps = false;

    public function session()
    {
        return $this->belongsTo(AttendanceSession::class, 'attendance_session_id');
    }

    public function batch()
    {
        return $this->belongsTo(AttendanceBatch::class, 'batch_id');
    }
}
