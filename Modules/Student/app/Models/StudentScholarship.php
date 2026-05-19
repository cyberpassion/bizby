<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScholarship extends Model
{
    protected $fillable = [
        'student_id',
        'year_id',
        'name',
        'code',
        'provider',
        'category',
        'amount',
        'percentage',
        'is_full_scholarship',
        'start_date',
        'end_date',
        'is_lifetime',
        'approval_status',
        'approved_at',
        'approved_by',
        'reason',
        'remarks',
        'terms_conditions',
        'document',
        'certificate',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'percentage' => 'decimal:2',
        'is_full_scholarship' => 'boolean',
        'is_lifetime' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function year()
    {
        return $this->belongsTo(
            StudentAcademicYear::class,
            'year_id'
        );
    }
}
