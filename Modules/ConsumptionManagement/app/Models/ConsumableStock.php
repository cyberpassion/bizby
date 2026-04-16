<?php

namespace Modules\ConsumptionManagement\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsumableStock extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'center_id',
        'type',
        'quantity',
        'unit',
        'low_threshold',
    ];

    public function center()
    {
        return $this->belongsTo(\Modules\Center\Models\Center::class);
    }
}