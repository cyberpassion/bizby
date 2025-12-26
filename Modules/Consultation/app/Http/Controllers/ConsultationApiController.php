<?php

namespace Modules\Consultation\Http\Controllers;

use Modules\Consultation\Models\Consultation;
use Modules\Shared\Http\Controllers\SharedApiController;

class ConsultationApiController extends SharedApiController
{
    protected function model()
    {
        return Consultation::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	// Default Graphs to Display
	protected function allowedCharts(): array
    {
        return [
           'gender',              // Male / Female / Other
           'channel',             // Web / Mobile / Walk-in / API
           'consultation_type',   // Online / Offline / Video etc.
           'consultant_type',     // Doctor / Counselor / Expert
           'category',            // General / OBC / SC / ST
           'marital_status',      // Single / Married / Widowed / Divorced
           'consultation_date',   // Date-wise trend
           'consultant_id',       // Consultant-wise load
           'age_group'            // Age range graph (logic based)
        ];
    }


	// Default Metrics
	protected function defaultMetrics(): array
    {
        return [
           'total_records',          // Total consultations / entries
           'total_revenue'           // Sum of consultation_fee
        ];
    }


	// Default Sums
	protected function defaultAggregates(): array
    {
        return [
           'count:gender=M',                 // Male count
           'count:gender=F',                 // Female count
           'count:consultation_type',        // Type-wise count
           'sum:consultation_fee',           // Total revenue
           'count:channel'                   // Channel-wise count
        ];
    }


	// Default grouping columns
	protected function defaultGroups(): array
    {
        return [
           'gender',              // Gender graph
           'channel',             // Channel-wise graph
           'consultation_type',   // Consultation type graph
           'consultation_date'    // Date-wise trend
        ];
    }
}
