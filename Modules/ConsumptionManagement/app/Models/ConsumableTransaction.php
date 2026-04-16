<?php

namespace Modules\ConsumptionManagement\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsumableTransaction extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'center_id',
        'mode',
        'type',
        'quantity',
        'entry_datetime',
        'user',
        'vehicle',
        'incident_id',
        'supplier',
    ];

    public function center()
    {
        return $this->belongsTo(\Modules\Center\Models\Center::class);
    }

    public function incident()
    {
        return $this->belongsTo(\Modules\Incident\Models\Incident::class, 'incident_id', 'incident_code');
    }
}