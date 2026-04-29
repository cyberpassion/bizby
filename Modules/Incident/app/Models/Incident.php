<?php

namespace Modules\Incident\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incident extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'center_id',
        'incident_code',
        'type',
        'location',
        'severity',
        'incident_date',
        'incident_time',
        'reporter_name',
		'reporter_contact',
    	'resolved_at',
    	'acknowledged_at',
    	'closed_at',
        'status',
    ];

	protected $casts = [
    	'incident_date' => 'date:Y-m-d',
    	'incident_time' => 'datetime:H:i',

	    'resolved_at' => 'datetime',
    	'acknowledged_at' => 'datetime',
    	'closed_at' => 'datetime',
	];

	protected static function boot()
    {
        parent::boot();

        static::creating(function ($incident) {

            // Year-based prefix
            $year = date('Y');

            // Get last record for this year
            $last = self::whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = 1;

            if ($last && $last->incident_code) {
                // Extract last number
                preg_match('/(\d+)$/', $last->incident_code, $matches);
                $nextNumber = isset($matches[1]) ? ((int)$matches[1] + 1) : 1;
            }

            // Format: INC-2026-0001
            $incident->incident_code = 'INC-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function center()
    {
        return $this->belongsTo(\Modules\Center\Models\Center::class);
    }

	public function logs()
	{
    	return $this->hasMany(IncidentLog::class);
	}

	public function closure()
	{
    	return $this->hasOne(IncidentClosure::class);
	}

}