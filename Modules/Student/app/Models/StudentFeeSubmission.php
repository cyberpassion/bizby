<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeSubmission extends TenantModel
{
	use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    |
    | Includes:
    | - commonSaasFields()
    | - fee submission specific fields
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
        | Fee Submission
        |--------------------------------------------------------------------------
        */

        'student_id',

        'year_id',

        'class_term_id',
        'section_term_id',

        'total_amount',
        'total_discount',
        'amount_received',

        'remarks',

        'fee_status',

		'paid_at',

        'reversed_at',
        'reversed_by',

        'reversal_reason',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'meta' => 'array',

        'reversed_at' => 'datetime',
		'paid_at'=> 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | Appended Attributes
    |--------------------------------------------------------------------------
    |
    | Disabled for performance reasons.
    | Relationship-based appends can create N+1 query issues.
    |
    */

	/*
    protected $appends = [
	    'student_name',
    	'phone',
	    'father_name',
    	'academic_year_name',
    	'class_name',
    	'section_name',
	];
    */

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

	// Fee submission items
    public function items()
    {
        return $this->hasMany(
            StudentFeeSubmissionItem::class,
            'fee_submission_id'
        );
    }

	// Student
	public function student()
	{
    	return $this->belongsTo(Student::class);
	}

	// Academic year
	public function academicYear()
	{
    	return $this->belongsTo(
        	StudentAcademicYear::class,
	        'year_id'
    	);
	}

	// Class term
	public function classTerm()
	{
    	return $this->belongsTo(
    	    \Modules\Shared\Models\Term::class,
        	'class_term_id'
	    )->where('group', 'classes');
	}

	// Section term
	public function sectionTerm()
	{
    	return $this->belongsTo(
	        \Modules\Shared\Models\Term::class,
    	    'section_term_id'
    	)->where('group', 'sections');
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

	public function getPhoneAttribute()
	{
    	return $this->student?->phone;
	}

	public function getFatherNameAttribute()
	{
    	return $this->student?->father_name;
	}

	public function getAcademicYearNameAttribute()
	{
    	return $this->academicYear?->name;
	}

	public function getClassNameAttribute()
	{
    	return $this->classTerm?->name;
	}

	public function getSectionNameAttribute()
	{
    	return $this->sectionTerm?->name;
	}
}