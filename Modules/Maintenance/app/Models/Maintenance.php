<?php

namespace Modules\Maintenance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'center_id',
        'asset',
        'issue_type',
        'description',
        'reported_date',
        'assigned_technician',
        'cost',
        'next_service_date',
        'status',
    ];

	 /**
     * Attribute casting.
     */
    protected $casts = [
		'datetime'			=> 'datetime',
        'reported_date' => 'date:Y-m-d', // Laravel will cast it to Carbon
		'next_service_date' => 'date:Y-m-d', // Laravel will cast it to Carbon
    ];

    public function center()
    {
        return $this->belongsTo(\Modules\Center\Models\Center::class);
    }
}