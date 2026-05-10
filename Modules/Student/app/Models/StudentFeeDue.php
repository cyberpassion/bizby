<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFeeDue extends Model
{
    protected $fillable = [

        'student_id',

        'year_id',

        'class_term_id',

        'section_term_id',

        'fee_structure_id',

        'due_type',

        'period',

        'total_amount',

        'discount_amount',

        'paid_amount',

        'due_amount',

        'source_year_id',

        'meta',
    ];

    protected $casts = [

        'meta' => 'array',
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
    | Fee Structure
    |--------------------------------------------------------------------------
    */

    public function feeStructure()
    {
        return $this->belongsTo(
            StudentFeeStructure::class,
            'fee_structure_id'
        );
    }
}