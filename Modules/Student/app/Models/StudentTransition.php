<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Shared\Models\Term;

class StudentTransition extends Model
{
    use HasFactory;

    protected $table = 'student_transitions';

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Student
        |--------------------------------------------------------------------------
        */

        'student_id',

        /*
        |--------------------------------------------------------------------------
        | Transition Type
        |--------------------------------------------------------------------------
        */

        'transition_type',

        /*
        |--------------------------------------------------------------------------
        | Source Academic Structure
        |--------------------------------------------------------------------------
        */

        'source_year_id',
        'source_class_term_id',
        'source_section_term_id',

        /*
        |--------------------------------------------------------------------------
        | Target Academic Structure
        |--------------------------------------------------------------------------
        */

        'target_year_id',
        'target_class_term_id',
        'target_section_term_id',

        /*
        |--------------------------------------------------------------------------
        | Transition Info
        |--------------------------------------------------------------------------
        */

        'effective_from',
        'transition_status',
        'remarks',

        /*
        |--------------------------------------------------------------------------
        | Audit
        |--------------------------------------------------------------------------
        */

        'processed_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Source Relations
    |--------------------------------------------------------------------------
    */

    public function sourceAcademicYear()
    {
        return $this->belongsTo(
            StudentAcademicYear::class,
            'source_year_id'
        );
    }

    public function sourceClass()
    {
        return $this->belongsTo(
            Term::class,
            'source_class_term_id'
        );
    }

    public function sourceSection()
    {
        return $this->belongsTo(
            Term::class,
            'source_section_term_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Target Relations
    |--------------------------------------------------------------------------
    */

    public function targetAcademicYear()
    {
        return $this->belongsTo(
            StudentAcademicYear::class,
            'target_year_id'
        );
    }

    public function targetClass()
    {
        return $this->belongsTo(
            Term::class,
            'target_class_term_id'
        );
    }

    public function targetSection()
    {
        return $this->belongsTo(
            Term::class,
            'target_section_term_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Processed By
    |--------------------------------------------------------------------------
    */

    public function processedBy()
    {
        return $this->belongsTo(
            User::class,
            'processed_by'
        );
    }
}