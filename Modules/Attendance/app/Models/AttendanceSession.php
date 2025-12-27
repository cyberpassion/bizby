<?php

namespace Modules\Attendance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceSession extends Model
{
    use HasFactory;

    protected $table = 'attendance_sessions';

    protected $fillable = [
        'type',
        'session_date',
        'start_time',
        'end_time',
        'context',
        'reference',
        'taken_by_id',
        'taken_by_type',
    ];

    protected $casts = [
        'session_date' => 'date',
        'start_time'   => 'datetime:H:i',
        'end_time'     => 'datetime:H:i',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function attendances()
    {
        return $this->hasMany(
            Attendance::class,
            'attendance_session_id'
        );
    }

    public function takenBy()
    {
        return $this->morphTo(
            __FUNCTION__,
            'taken_by_type',
            'taken_by_id'
        );
    }
}
