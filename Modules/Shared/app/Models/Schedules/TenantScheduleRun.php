<?php

namespace Modules\Shared\Models\Schedules;

use Illuminate\Database\Eloquent\Model;

class TenantScheduleRun extends Model
{
    protected $fillable = [
        'schedule_id',
        'tenant_id',
        'status',
        'started_at',
        'finished_at',
        'error',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}
