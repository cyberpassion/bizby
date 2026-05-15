<?php

namespace Modules\Student\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeeSubmission extends TenantModel
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Common SaaS Fields
        |--------------------------------------------------------------------------
        */

        'tenant_id',

        'status',

        'created_by',
        'updated_by',
        'deleted_by',

        'entry_source',
        'entry_source_ref_id',

        'remark',
        'system_remark',

        'meta',

        /*
        |--------------------------------------------------------------------------
        | Academic
        |--------------------------------------------------------------------------
        */

        'student_id',

        'year_id',

        'class_term_id',

        'section_term_id',

        /*
        |--------------------------------------------------------------------------
        | Receipt
        |--------------------------------------------------------------------------
        */

        'receipt_no',

        'request_uuid',

        'receipt_date',

        /*
        |--------------------------------------------------------------------------
        | Amounts
        |--------------------------------------------------------------------------
        */

        'gross_amount',

		'discount_amount',

		'fine_amount',

		'paid_amount',

		'balance_amount',

        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */

        'payment_mode',

        'transaction_reference',

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        'fee_status',

        'submission_status',

        /*
        |--------------------------------------------------------------------------
        | Remarks
        |--------------------------------------------------------------------------
        */

        'remarks',

        'submitted_by',

        'paid_at',

        /*
        |--------------------------------------------------------------------------
        | Cancellation
        |--------------------------------------------------------------------------
        */

        'cancelled_at',

        'cancelled_by',

        'cancellation_reason',

        /*
        |--------------------------------------------------------------------------
        | Legacy Reversal Support
        |--------------------------------------------------------------------------
        */

        'reversed_at',

        'reversed_by',

        'reversal_reason',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'meta' => 'array',

        'receipt_date' => 'datetime',

        'paid_at' => 'datetime',

        'cancelled_at' => 'datetime',

        'reversed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Submission Items
     */
    public function items()
    {
        return $this->hasMany(
            StudentFeeSubmissionItem::class,
            'submission_id'
        );
    }

    /**
     * Student
     */
    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }

    /**
     * Academic Year
     */
    public function academicYear()
    {
        return $this->belongsTo(
            StudentAcademicYear::class,
            'year_id'
        );
    }

    /**
     * Class Term
     */
    public function classTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'class_term_id'
        )->where('group', 'classes');
    }

    /**
     * Section Term
     */
    public function sectionTerm()
    {
        return $this->belongsTo(
            \Modules\Shared\Models\Term::class,
            'section_term_id'
        )->where('group', 'sections');
    }

    /**
     * Submitted By
     */
    public function submittedBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'submitted_by'
        );
    }

    /**
     * Cancelled By
     */
    public function cancelledBy()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'cancelled_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getStudentNameAttribute()
    {
        return $this->student?->name;
    }

    public function getPhoneAttribute()
    {
        return $this->student?->phone;
    }

    public function getFatherNameAttribute()
    {
        return $this->student?->father_name;
    }

    public function getAcademicYearNameAttribute()
    {
        return $this->academicYear?->name;
    }

    public function getClassNameAttribute()
    {
        return $this->classTerm?->name;
    }

    public function getSectionNameAttribute()
    {
        return $this->sectionTerm?->name;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Check if receipt is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->submission_status
            === 'cancelled';
    }

    /**
     * Check if payment successful
     */
    public function isSuccessful(): bool
    {
        return $this->submission_status
            === 'success';
    }
}