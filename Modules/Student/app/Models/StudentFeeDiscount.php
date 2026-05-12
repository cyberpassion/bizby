<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFeeDiscount extends Model
{
    protected $fillable = [

        'student_id',

        'student_fee_structure_id',

        'year_id',

        'name',

        'amount',

        'percentage',

        'applicable_periods',

		'reason'
    ];

    protected $casts = [

        'applicable_periods' => 'array',
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
            'student_fee_structure_id'
        );
    }
}