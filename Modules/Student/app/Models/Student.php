<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Student\Models\Traits\StudentPayable;

// Online Payments Specific
use Modules\Shared\Contracts\OnlinePayments\Payable;
use Modules\Shared\Contracts\OnlinePayments\FinalizePayment;

class Student extends Model implements Payable, FinalizePayment
{
    use HasFactory;
	use StudentPayable; // Payable implementation trait

    // dynamically allow all columns except id, timestamps, deleted_at
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

	protected $casts = [
        'admission_date' => 'date:Y-m-d',
    ];

	protected $appends = [
    	'academic_year_name',
		'class_term_id',
		'section_term_id',
    	'class_name',
    	'section_name',
	];

    public function academicHistories()
	{
    	return $this->hasMany(StudentAcademicHistory::class);
	}

	public function currentAcademicHistory()
	{
    	return $this->hasOne(StudentAcademicHistory::class)->where('is_current', true);
	}

	public function getAcademicYearNameAttribute()
	{
    	return $this->currentAcademicHistory?->academicYear?->name;
	}

	public function getClassNameAttribute()
	{
    	return $this->currentAcademicHistory?->classTerm?->name;
	}

	public function getSectionNameAttribute()
	{
    	return $this->currentAcademicHistory?->sectionTerm?->name;
	}

	public function getClassTermIdAttribute()
	{
    	return $this->currentAcademicHistory?->classTerm?->id;
	}

	public function getSectionTermIdAttribute()
	{
    	return $this->currentAcademicHistory?->sectionTerm?->id;
	}

}
