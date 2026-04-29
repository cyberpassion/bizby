<?php

namespace Modules\Incident\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Tenants\TenantModel;

class IncidentLog extends TenantModel
{
    protected $fillable = [
        'tenant_id',
        'incident_id',
        'event',
        'notes',
        'user_id',
    ];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}