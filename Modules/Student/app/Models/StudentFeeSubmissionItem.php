<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeSubmissionItem extends TenantModel
{
	use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    |
    | Includes:
    | - commonSaasFields()
    | - fee submission item fields
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
        | Fee Submission Item
        |--------------------------------------------------------------------------
        */

        'fee_submission_id',

        'fee_structure_id',

        'payable_amount',

        'discount_applied',

        'paid_amount',

        'selected_periods',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

	protected $casts = [

        // Automatically decode JSON
        'selected_periods' => 'array',

        'meta' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Parent fee submission
    public function submission()
    {
        return $this->belongsTo(
            StudentFeeSubmission::class,
            'fee_submission_id'
        );
    }
}