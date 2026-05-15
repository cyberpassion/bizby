<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;

class StudentFeeDiscount extends TenantModel
{

    protected $fillable = [

        'student_id',

        'year_id',

        'head_term_id',

        'pattern_id',

        'name',

        'amount',

        'percentage',

        'applicable_period_keys',

        'reason',
    ];

    protected $casts = [

        'applicable_period_keys'
            => 'array',
    ];

	/*
	|--------------------------------------------------------------------------
	| Appends
	|--------------------------------------------------------------------------
	*/

	protected $appends = [

	    'student_name',

	    'year_name',

	    'head_name',

	    'pattern_name',
	];

    /*
    |--------------------------------------------------------------------------
    | Student
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Academic Year
    |--------------------------------------------------------------------------
    */

    public function year()
    {
        return $this->belongsTo(
            StudentAcademicYear::class,
            'year_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Fee Head
    |--------------------------------------------------------------------------
    */

    public function headTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'head_term_id'
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

    /*
    |--------------------------------------------------------------------------
    | Pattern
    |--------------------------------------------------------------------------
    */

    public function pattern()
    {
        return $this->belongsTo(
            StudentFeeStructurePattern::class,
            'pattern_id'
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

	public function getHeadTermNameAttribute()
	{
    	return $this->headTerm?->name;
	}

	public function getClassNameAttribute()
	{
    	return $this->classTerm?->name;
	}

	public function getHeadNameAttribute()
	{
    	return $this->headTerm?->name;
	}

	public function getSectionNameAttribute()
	{
    	return $this->sectionTerm?->name;
	}

	public function getPatternNameAttribute()
	{
    	return $this->pattern?->name;
	}

}