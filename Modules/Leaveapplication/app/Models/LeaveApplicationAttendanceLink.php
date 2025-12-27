<?php

namespace Modules\Leaveapplication\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveapplicationAttendanceLink extends Model
{
    protected $table = 'leaveapplication_attendance_links';

    protected $fillable = [
        'leaveapplication_id',
        'attendance_id',
    ];

    public function leaveapplication()
    {
        return $this->belongsTo(
            Leaveapplication::class,
            'leaveapplication_id'
        );
    }
}
