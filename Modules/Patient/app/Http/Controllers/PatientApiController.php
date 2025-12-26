<?php

namespace Modules\Patient\Http\Controllers;

use Modules\Patient\Models\Patient;
use Modules\Shared\Http\Controllers\SharedApiController;

class PatientApiController extends SharedApiController
{
    protected function model()
    {
        return Patient::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
            'gender',                 // Male / Female / Other
            'patient_type',           // OPD / IPD / Emergency
            'category',               // General / OBC / SC / ST
            'marital_status',         // Single / Married etc.
            'age_group',              // Age buckets (derived from age)
            'is_emergency_case',      // Emergency vs Normal
            'admitted_by_type',       // Doctor / Staff / Police etc.
            'treatment_under',        // Department / Unit wise
            'referred_by',            // Referral source
            'referred_to',            // Referral destination
            'room_number',            // Room occupancy (top)
            'entry_source',           // Web / Mobile / System
            'admission_date',         // Daily / Monthly admissions
            'discharge_date'          // Discharge trend
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_patients',            // Total patient records
            'active_admissions',         // discharge_date IS NULL
            'discharged_patients',       // discharge_date IS NOT NULL
            'emergency_cases',           // is_emergency_case = Yes
            'today_admissions'           // admission_date = today
        ];
    }
    protected function defaultAggregates(): array
    {
        return [
            'count:gender',                  // Gender-wise patients
            'count:patient_type',            // OPD / IPD / Emergency
            'count:is_emergency_case',       // Emergency vs Normal
            'count:treatment_under',         // Department-wise
            'count:admitted_by_type',        // Doctor / Police / Staff
            'count:referred_by',             // Referral source
            'count:referred_to'              // Referral destination
        ];
    }
    protected function defaultGroups(): array
    {
        return [
        'gender',               // Gender distribution
        'patient_type',         // Patient type chart
        'is_emergency_case',    // Emergency vs Normal
        'treatment_under',      // Department workload
        'entry_source',         // Entry source
        'admission_date',       // Admission trend
        'discharge_date'        // Discharge trend
    ];
}






}
