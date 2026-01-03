<?php

namespace Modules\Shared\Models\Schedules;

use Illuminate\Database\Eloquent\Model;

class TenantSchedule extends Model
{
    protected $fillable = [
        'tenant_id',
        'name',
        'job_key',
        'frequency',
        'cron_expression',
        'run_at',
        'timezone',
        'is_active',
        'last_run_at',
        'next_run_at',
        'meta',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta' => 'array',
        'run_at' => 'datetime:H:i',
    ];

    public function runs()
    {
        return $this->hasMany(TenantScheduleRun::class, 'schedule_id');
    }
}
