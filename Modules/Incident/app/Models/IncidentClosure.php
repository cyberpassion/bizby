<?php

namespace Modules\Incident\Models;

use Modules\Admin\Models\Tenants\TenantModel;

class IncidentClosure extends TenantModel
{
    protected $fillable = [
        'tenant_id',
        'incident_id',
        'resolution_summary',
        'root_cause',
        'preventive_measures',
        'closed_by',
    ];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}