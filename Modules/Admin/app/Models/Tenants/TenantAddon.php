<?php

namespace Modules\Admin\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class TenantAddon extends Model
{

	use HasFactory;

    protected $table = 'tenant_addons';

    protected $fillable = [
        'tenant_id',
        'addon_id',
        'addon_key',
        'addon_name',
        'activated_at',
        'deactivated_at',
        'price',
        'valid_till',
        'is_active',
    ];

    protected $casts = [
        'activated_at'   => 'datetime',
        'deactivated_at' => 'datetime',
        'valid_till'     => 'date',
        'is_active'      => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // 🔹 Belongs to Tenant
    public function tenant()
    {
        return $this->belongsTo(\Modules\Admin\Models\Tenants\TenantAccount::class, 'tenant_id');
    }

    // 🔹 Belongs to Addon master (optional)
    public function addon()
    {
        return $this->belongsTo(\Modules\Admin\Models\Tenants\TenantAddon::class, 'addon_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES (VERY USEFUL)
    |--------------------------------------------------------------------------
    */

    // Only active addons
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('valid_till')
                  ->orWhereDate('valid_till', '>=', now());
            });
    }
}