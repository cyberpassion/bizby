<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class StudentClassHistory extends Model
{
	use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_level_id',
        'academic_level_id',
        'academic_year',
        'promoted_on',
    ];

    protected $casts = [
        'promoted_on' => 'date',
    ];

	protected static function newFactory()
	{
    	return \Modules\Student\Database\Factories\StudentClassHistoryFactory::new();
	}

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(AcademicClass::class);
    }

    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class);
    }
}
