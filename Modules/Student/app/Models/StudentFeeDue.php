<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;

class StudentFeeDue extends TenantModel
{
    protected $fillable = [

        'student_id',

        'year_id',

        'class_term_id',

        'section_term_id',

        /*
        |--------------------------------------------------------------------------
        | Relations
        |--------------------------------------------------------------------------
        */

        'structure_id',

        'head_term_id',

        'pattern_period_id',

        /*
        |--------------------------------------------------------------------------
        | Due Info
        |--------------------------------------------------------------------------
        */

        'due_type',

        'amount',

        'paid_amount',

        'fine_amount',

        'waiver_amount',

        'balance_amount',

        'dues_status',

        'due_date',

        /*
        |--------------------------------------------------------------------------
        | Snapshots
        |--------------------------------------------------------------------------
        */

        'head_name',

        'pattern_name',

        'period_name',

        /*
        |--------------------------------------------------------------------------
        | Extra
        |--------------------------------------------------------------------------
        */

        'source_year_id',

        'generated_at',

        'meta',
    ];

    protected $casts = [

        'meta' => 'array',

        'generated_at' => 'datetime',

        'due_date' => 'date',
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
    | Structure
    |--------------------------------------------------------------------------
    */

    public function structure()
    {
        return $this->belongsTo(
            StudentFeeStructure::class,
            'structure_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Head
    |--------------------------------------------------------------------------
    */

    public function headTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'head_term_id'
        );
    }

	/*
    |--------------------------------------------------------------------------
    | Class Term
    |--------------------------------------------------------------------------
    */

    public function classTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'class_term_id'
        );
    }

	/*
    |--------------------------------------------------------------------------
    | Section Term
    |--------------------------------------------------------------------------
    */

    public function sectionTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'section_term_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Pattern Period
    |--------------------------------------------------------------------------
    */

    public function patternPeriod()
    {
        return $this->belongsTo(
            StudentFeeStructurePatternPeriod::class,
            'pattern_period_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Submission Items
    |--------------------------------------------------------------------------
    */

    public function submissionItems()
    {
        return $this->hasMany(
            StudentFeeSubmissionItem::class,
            'due_id'
        );
    }
}