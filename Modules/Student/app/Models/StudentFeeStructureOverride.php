<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeStructureOverride extends TenantModel
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
        | Student
        |--------------------------------------------------------------------------
        */

        'student_id',

        /*
        |--------------------------------------------------------------------------
        | Optional Base Structure Reference
        |--------------------------------------------------------------------------
        */

        'fee_structure_id',

        /*
        |--------------------------------------------------------------------------
        | Pattern
        |--------------------------------------------------------------------------
        */

        'pattern_id',

        /*
        |--------------------------------------------------------------------------
        | Amount Type
        |--------------------------------------------------------------------------
        */

        'amount_type',

        /*
        |--------------------------------------------------------------------------
        | Context
        |--------------------------------------------------------------------------
        */

        'year_id',

        'class_term_id',

        'section_term_id',

        /*
        |--------------------------------------------------------------------------
        | Fee Head
        |--------------------------------------------------------------------------
        */

        'head_term_id',

        /*
        |--------------------------------------------------------------------------
        | Amount
        |--------------------------------------------------------------------------
        */

        'amount',

        /*
        |--------------------------------------------------------------------------
        | Extra
        |--------------------------------------------------------------------------
        */

        'reason',
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
	| Appends
	|--------------------------------------------------------------------------
	*/

	protected $appends = [

	    'student_name',

	    'year_name',

	    'class_name',

	    'section_name',

	    'head_name',

	    'pattern_name',
	];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Student
     */
    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }

    /**
     * Base Fee Structure
     */
    public function feeStructure()
    {
        return $this->belongsTo(
            StudentFeeStructure::class,
            'fee_structure_id'
        );
    }

    /**
     * Pattern
     */
    public function pattern()
    {
        return $this->belongsTo(
            StudentFeeStructurePattern::class,
            'pattern_id'
        );
    }

    /**
     * Academic Year
     */
    public function year()
    {
        return $this->belongsTo(
            StudentAcademicYear::class,
            'year_id'
        );
    }

    /**
     * Class
     */
    public function classTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'class_term_id'
        );
    }

    /**
     * Section
     */
    public function sectionTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'section_term_id'
        );
    }

    /**
     * Fee Head
     */
    public function headTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'head_term_id'
        );
    }

	/*
	|--------------------------------------------------------------------------
	| Accessors
	|--------------------------------------------------------------------------
	*/

	public function getStudentNameAttribute()
	{
    	return $this->student?->name;
	}

	public function getYearNameAttribute()
	{
    	return $this->year?->name;
	}

	public function getClassNameAttribute()
	{
    	return $this->classTerm?->name;
	}

	public function getSectionNameAttribute()
	{
    	return $this->sectionTerm?->name;
	}

	public function getHeadNameAttribute()
	{
    	return $this->headTerm?->name;
	}

	public function getPatternNameAttribute()
	{
    	return $this->pattern?->name;
	}

}