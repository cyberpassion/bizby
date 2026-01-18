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
        'attendance_status',
		'source',
        'in_time',
        'out_time',
        'code',
        'reason',
    ];

    protected $casts = [
	    'in_time'  => 'string',
    	'out_time' => 'string',
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

	public function scopePresent($q)
	{
    	return $q->where('attendance_status', 'present');
	}

}
