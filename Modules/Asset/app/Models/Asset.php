<?php

namespace Modules\Asset\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends TenantModel
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'tenant_id',

        // Basic Info
        'asset_code',
        'name',
        'type',

        // Identification
        'unique_id',
        'serial_number',

        // Purchase Info
        'purchase_date',
        'purchase_cost',
        'vendor',

        // Assignment
        'center_id',
        'assigned_to',

        // Status
        'status',

        // Maintenance
        'last_service_date',
        'next_service_date',

        // Lifecycle
        'warranty_expiry',
        'useful_life_months',

        // Extra
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_service_date' => 'date',
        'next_service_date' => 'date',
        'warranty_expiry' => 'date',

        'purchase_cost' => 'float',
        'useful_life_months' => 'integer',
    ];

    /* ======================================================
     | AUTO GENERATE ASSET CODE
     ====================================================== */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($asset) {

            if (!$asset->asset_code) {
                $year = date('Y');

                $last = self::whereYear('created_at', $year)
                    ->orderBy('id', 'desc')
                    ->first();

                $next = 1;

                if ($last && $last->asset_code) {
                    preg_match('/\d+$/', $last->asset_code, $matches);
                    $next = isset($matches[0]) ? (int)$matches[0] + 1 : 1;
                }

                $asset->asset_code = 'AST-' . $year . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    /* ======================================================
     | RELATIONSHIPS (OPTIONAL BUT RECOMMENDED)
     ====================================================== */

    // Center (if you have centers table)
    public function center()
    {
        return $this->belongsTo(\Modules\Center\Models\Center::class, 'center_id');
    }

    // Assigned User / Employee
    public function assignedUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    /* ======================================================
     | SCOPES (USEFUL FOR FILTERS)
     ====================================================== */

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInRepair($query)
    {
        return $query->where('status', 'repair');
    }

    public function scopeNotWorking($query)
    {
        return $query->where('status', 'not_working');
    }

    /* ======================================================
     | ACCESSORS (OPTIONAL)
     ====================================================== */

    public function getIsOverdueForServiceAttribute()
    {
        return $this->next_service_date &&
               $this->next_service_date->isPast();
    }
}