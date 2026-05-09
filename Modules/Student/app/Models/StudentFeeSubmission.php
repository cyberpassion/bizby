<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentFeeSubmission extends TenantModel
{
	use HasFactory;

    protected $fillable = [];

    protected $casts = [];

	protected $appends = [
	    'student_name',
    	'phone',
	    'father_name',
    	'academic_year_name',
    	'class_name',
    	'section_name',
	];

	// Relationship with submission items
    public function items()
    {
        return $this->hasMany(StudentFeeSubmissionItem::class, 'fee_submission_id');
    }

	protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }

	public function student()
	{
    	return $this->belongsTo(Student::class);
	}

	public function academicYear()
	{
    	return $this->belongsTo(
        	StudentAcademicYear::class,
	        'year_id'
    	);
	}

	public function classTerm()
	{
    	return $this->belongsTo(
    	    \Modules\Shared\Models\Term::class,
        	'class_term_id'
	    )->where('group', 'classes');
	}

	public function sectionTerm()
	{
    	return $this->belongsTo(
	        \Modules\Shared\Models\Term::class,
    	    'section_term_id'
    	)->where('group', 'sections');
	}

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
