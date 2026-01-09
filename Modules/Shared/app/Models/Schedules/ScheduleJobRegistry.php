<?php

namespace Modules\Shared\Models\Schedules;

use Illuminate\Database\Eloquent\Model;

class ScheduleJobRegistry extends Model
{
    protected $table = 'schedule_job_registry';

    protected $fillable = [
        'key',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: only active jobs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
