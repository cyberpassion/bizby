<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeStructure extends TenantModel
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Common SaaS
        |--------------------------------------------------------------------------
        */

        'tenant_id',

        'status',

        'created_by',
        'updated_by',
        'deleted_by',

        'entry_source',
        'entry_source_ref_id',

        'remark',
        'system_remark',

        'meta',

        /*
        |--------------------------------------------------------------------------
        | Fee Structure
        |--------------------------------------------------------------------------
        */

        'pattern_id',

        'year_id',

        'class_term_id',
        'section_term_id',

        'head_term_id',

        'amount',

        'amount_type',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'meta' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function headTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'head_term_id'
        );
    }

    public function pattern()
    {
        return $this->belongsTo(
            StudentFeeStructurePattern::class,
            'pattern_id'
        );
    }
}