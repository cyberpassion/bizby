<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Student extends Model
{
	use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'mobile',
        'dob',
        'gender',

        'academic_level_id',
        'academic_level_id',
        'academic_year',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentFactory::new();
	}

    public function class()
    {
        return $this->belongsTo(AcademicClass::class, 'academic_level_id');
    }

    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function feeTransactions()
    {
        return $this->hasMany(StudentFeeTransaction::class, 'student_id');
    }

    public function optionalFees()
    {
        return $this->hasMany(StudentOptionalFee::class, 'student_id');
    }
}
