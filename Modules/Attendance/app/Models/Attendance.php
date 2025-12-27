<?php

namespace Modules\Attendance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'attendance_session_id',
        'entity_id',
        'entity_type',
        'status',
        'in_time',
        'out_time',
        'code',
        'reason',
    ];

    protected $casts = [
        'in_time'  => 'datetime:H:i',
        'out_time' => 'datetime:H:i',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function session()
    {
        return $this->belongsTo(
            AttendanceSession::class,
            'attendance_session_id'
        );
    }

    public function entity()
    {
        return $this->morphTo();
    }
}
