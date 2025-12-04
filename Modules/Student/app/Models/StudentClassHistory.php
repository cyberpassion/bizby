<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Student\Models\Student;

class StudentClassHistory extends Model
{

    protected $fillable = [
        'student_id',
        'class_id',
        'academic_year',
        'from_date',
        'to_date',
        'status',
        'reason'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
