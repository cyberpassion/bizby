<?php

namespace Modules\Shared\Models\Schedules;

use Illuminate\Database\Eloquent\Model;

class TenantScheduleLock extends Model
{
    protected $fillable = [
        'schedule_id',
        'tenant_id',
        'locked_until',
    ];

    protected $casts = [
        'locked_until' => 'datetime',
    ];
}
