<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeStructureOverride extends TenantModel
{
	use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    |
    | Includes:
    | - commonSaasFields()
    | - fee override specific fields
    |
    */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | commonSaasFields()
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
        | Fee Structure Override
        |--------------------------------------------------------------------------
        */

        'student_id',

        'fee_structure_id',

        'override_amount',

        'selected_periods',

        'reason',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

	    'selected_periods' => 'array',

        'meta' => 'array',
	];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Base fee structure
	public function feeStructure()
	{
    	return $this->belongsTo(
            StudentFeeStructure::class,
            'fee_structure_id'
        );
	}
}