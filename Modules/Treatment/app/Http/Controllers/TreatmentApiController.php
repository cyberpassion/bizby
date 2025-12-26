<?php

namespace Modules\Treatment\Http\Controllers;

use Modules\Treatment\Models\Treatment;
use Modules\Shared\Http\Controllers\SharedApiController;

class TreatmentApiController extends SharedApiController
{
    protected function model()
    {
        return Treatment::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
            'treatment_date',              // Date-wise treatments
            'patient_status',              // Active / Improved / Discharged etc.
            'treatment_recipient_type',    // Doctor / Nurse / Department
            'treatment_recipient',         // Treated by (Top performers)
            'user_id',                     // User-wise treatments
            'entry_source',                // Web / Mobile / System
            'treatment_fee',               // Revenue trend (sum based)
            'patient_id'                   // Patients vs treatments count
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_treatments',          // Total treatment entries
            'total_patients',            // Distinct patient_id count
            'total_revenue',             // Sum of treatment_fee
            'today_treatments',          // treatment_date = today
            'active_patients'            // patient_status = Active
        ];
    }
    protected function defaultAggregates(): array
    {
        return [
            'count:patient_status',             // Status-wise treatments
            'count:treatment_recipient_type',   // Doctor / Nurse / Dept
            'count:user_id',                    // User-wise activity
            'sum:treatment_fee',                // Revenue
            'count:entry_source'                // Source-wise
        ];
    }
    protected function defaultGroups(): array
    {
        return [
            'patient_status',             // Status distribution
            'treatment_recipient_type',   // Role-wise treatments
            'user_id',                    // User workload
            'entry_source',               // Source breakdown
            'treatment_date'              // Date-wise treatment trend
        ];
    }





}
