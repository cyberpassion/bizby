<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Admin\Models\Tenants\TenantModel;

class StudentFeeStructurePatternPeriod extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'pattern_id',
        'key',
        'label',
        'start_date',
        'end_date',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function pattern()
    {
        return $this->belongsTo(
            StudentFeeStructurePattern::class,
            'pattern_id'
        );
    }
}