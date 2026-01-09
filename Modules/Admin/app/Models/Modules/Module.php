<?php

namespace Modules\Admin\Models\Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'key',
        'name',
        'description',
        'price',
        'is_billable',
        'is_core',
        'is_active',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'price'       => 'decimal:2',
        'is_billable' => 'boolean',
        'is_core'     => 'boolean',
        'is_active'   => 'boolean',
    ];

    /**
     * Scope: only active modules.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: only billable modules.
     */
    public function scopeBillable($query)
    {
        return $query->where('is_billable', true);
    }
}
