<?php

namespace Modules\Registration\Http\Controllers;

use Modules\Registration\Models\Registration;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationApiController extends SharedApiController
{
    protected function model()
    {
        return Registration::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
           'gender',              // Male / Female / Other
           'registration_type',   // Online / Offline / Camp etc.
           'session',             // Session wise registrations
           'category',            // General / OBC / SC / ST
           'religion',            // Religion wise distribution
           'marital_status',      // Single / Married / Widowed / Divorced
           'age_group',           // Age range based (logic derived)
           'entry_source',        // Web / Mobile / Employee / API
           'created_at'           // Date-wise registration trend
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
           'total_records',        // Total registrations
           'active_records',       // status = 1
           'inactive_records'      // status = 0
        ];
    }
    protected function defaultAggregates(): array
    {
        return [
            'count:gender',                 // Gender-wise count
            'count:registration_type',      // Registration type-wise
            'count:session',                // Session-wise
            'count:category',               // Category-wise
            'count:entry_source',            // Source-wise (web/mobile/etc)
            'count:marital_status'           // Marital status-wise
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'gender',              // Gender chart
            'registration_type',   // Type chart
            'session',             // Session chart
            'category',            // Category chart
            'entry_source',        // Source chart
            'created_at'           // Date-wise trend
        ];
   }



    public function extraStats()
	{
    	return [
       		'male_registrations' => Registration::where('gender', 'M')->count(),
        	'female_registrations' => Registration::where('gender', 'F')->count(),
        	'revenue_total' => 500000
    	];
	}


}
