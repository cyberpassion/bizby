<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Admin\Models\Tenants\TenantModel;

class StudentFeeStructurePattern extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'description',
        'is_customizable',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_customizable' => 'boolean',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function periods()
    {
        return $this->hasMany(
            StudentFeeStructurePatternPeriod::class,
            'pattern_id'
        )
        ->orderBy('sort_order');
    }

    public function feeStructures()
    {
        return $this->hasMany(
            StudentFeeStructure::class,
            'pattern_id'
        );
    }
}