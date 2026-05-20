<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Models\Tenants\TenantModel;

class EmployeeEducationHistory extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'institution_name',
        'institution_type',
        'institution_address',
        'city',
        'state',
        'country',
        'program_name',
        'specialization',
        'board_university',
        'medium',
        'roll_number',
        'admission_number',
        'registration_number',
        'percentage',
        'cgpa',
        'grade',
        'result_status',
        'passing_year',
        'from_date',
        'to_date',
        'is_current',
        'subjects',
        'achievements',
        'remarks',
        'reason_for_leaving',
        'marksheet',
        'transfer_certificate',
        'migration_certificate',
        'certificate',
        'id_card',
    ];

    protected $casts = [
        'subjects' => 'array',
        'from_date' => 'date',
        'to_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
