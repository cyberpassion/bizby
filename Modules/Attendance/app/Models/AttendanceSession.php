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
		'mode',
        'context',
        'reference',
        'taken_by_id',
        'taken_by_type',
    ];

    protected $casts = [
	    'session_date' => 'date',
    	'start_time'   => 'string',
    	'end_time'     => 'string',
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

	public function scopeForDate($q, $date)
	{
    	return $q->where('session_date', $date);
	}

	public function scopeOfType($q, $type)
	{
    	return $q->where('type', $type);
	}

	public function mark($entity, $status = 'present', array $extra = [])
	{
    	return $this->attendances()->updateOrCreate(
        	[
            	'entity_id' => $entity->id,
	            'entity_type' => get_class($entity),
    	    ],
        	array_merge([
            	'attendance_status' => $status,
	        ], $extra)
    	);
	}

}
