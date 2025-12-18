<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Shared\Models\Term;

class StudentPromotion extends Model
{
    use HasFactory;

    protected $table = 'student_promotions';

    protected $fillable = [
        'student_id',
        'from_class_term_id',
        'to_class_term_id',
        'from_section_term_id',
        'to_section_term_id',
        'student_academic_year_id',
        'type',
        'remarks',
    ];

    // -----------------------------
    // Relationships
    // -----------------------------
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromClass()
    {
        return $this->belongsTo(Term::class, 'from_class_term_id');
    }

    public function toClass()
    {
        return $this->belongsTo(Term::class, 'to_class_term_id');
    }

    public function fromSection()
    {
        return $this->belongsTo(Term::class, 'from_section_term_id');
    }

    public function toSection()
    {
        return $this->belongsTo(Term::class, 'to_section_term_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(StudentAcademicYear::class, 'student_academic_year_id');
    }
}
