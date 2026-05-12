<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeStructure extends TenantModel
{
	use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    |
    | Includes:
    | - commonSaasFields()
    | - fee structure specific fields
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
        | Fee Structure
        |--------------------------------------------------------------------------
        */

        'year_id',

        'class_term_id',
        'section_term_id',

        'head_term_id',

        'frequency',

        'amount',

        'selected_periods',
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
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Get fee amount for a specific month/period
     */
    public function amountForMonth(int|string $month): float
    {
        $month = str_pad(
            $month,
            2,
            '0',
            STR_PAD_LEFT
        );

        return $this->selected_periods[$month]
            ?? $this->amount;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

	// Fee head term
	public function headTerm()
	{
    	return $this->belongsTo(
	        \Modules\Shared\Models\Term::class,
    	    'head_term_id'
    	);
	}
}