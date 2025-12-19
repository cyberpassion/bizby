<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAcademicHistory extends Model
{
    use HasFactory;

    // allow all columns except id, timestamps
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(StudentAcademicYear::class, 'year_id');
    }

	public function classTerm()
    {
        return $this->belongsTo(\Modules\Shared\Models\Term::class, 'class_term_id');
    }

    public function sectionTerm()
    {
        return $this->belongsTo(\Modules\Shared\Models\Term::class, 'section_term_id');
    }

}
