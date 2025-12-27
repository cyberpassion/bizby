<?php

namespace Modules\Leaveapplication\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaveapplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leaveapplications';

    protected $fillable = [
        'entity_id',
        'entity_type',
        'start_date',
        'end_date',
        'type',
        'session_ref',
        'leave_code',
        'reason',
        'approval_status',
        'approved_by_id',
        'approved_by_type',
        'approved_at',
        'affects_attendance',
        'meta',
    ];

    protected $casts = [
        'start_date'         => 'date',
        'end_date'           => 'date',
        'approved_at'        => 'datetime',
        'affects_attendance' => 'boolean',
        'meta'               => 'array',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function entity()
    {
        return $this->morphTo();
    }

    public function approvedBy()
    {
        return $this->morphTo(
            __FUNCTION__,
            'approved_by_type',
            'approved_by_id'
        );
    }

    public function attendanceLinks()
    {
        return $this->hasMany(
            LeaveapplicationAttendanceLink::class,
            'leaveapplication_id'
        );
    }
}
