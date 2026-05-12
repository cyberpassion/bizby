<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAcademicYear extends TenantModel
{
	use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

	protected $table = "student_academic_years";

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    |
    | Includes:
    | - commonSaasFields()
    | - academic year specific fields
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
        | Academic Year
        |--------------------------------------------------------------------------
        */

        'name',

        'start_year',
        'end_year',

        'start_date',
        'end_date',

        'is_active',
        'is_locked',

        'description',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'start_date' => 'date',

        'end_date' => 'date',

        'is_active' => 'boolean',

        'is_locked' => 'boolean',

        'meta' => 'array',
    ];
}