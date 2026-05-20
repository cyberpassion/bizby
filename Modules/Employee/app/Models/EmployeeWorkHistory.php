<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Models\Tenants\TenantModel;

class EmployeeWorkHistory extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company_name',
        'designation',
        'department',
        'employment_type',
        'joining_date',
        'relieving_date',
        'is_current',
        'salary',
        'salary_currency',
        'job_description',
        'achievements',
        'reason_for_leaving',
        'city',
        'state',
        'country',
        'experience_letter',
        'salary_slip',
        'offer_letter',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'relieving_date' => 'date',
        'is_current' => 'boolean',
        'salary' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
