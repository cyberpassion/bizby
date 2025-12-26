<?php

namespace Modules\Customer\Http\Controllers;

use Modules\Customer\Models\Customer;
use Modules\Shared\Http\Controllers\SharedApiController;

class CustomerApiController extends SharedApiController
{
    protected function model()
    {
        return Customer::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
            'customer_type',        // Retail / Wholesale / Corporate
            'business_type',        // Trader / Manufacturer / Service
            'gender',               // Male / Female / Other
            'category',             // General / OBC / SC / ST
            'marital_status',       // Single / Married / Widowed / Divorced
            'age_group',            // Age buckets (derived)
            'state',                // State-wise customers
            'district',             // District-wise distribution
            'entry_source',         // Web / Mobile / Employee / API
            'created_at',           // Date-wise customer growth
            'next_date'             // Follow-up / next action tracking
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_records',            // Total customers / leads
            'active_records',           // status = 1
            'inactive_records',         // status = 0
            'followups_pending'         // next_date >= today
        ];
    }
    protected function defaultAggregates(): array
    {
        return [
            'count:customer_type',      // Retail / Corporate etc.
            'count:business_type',      // Trader / Manufacturer / Service
            'count:gender',             // Gender-wise
            'count:category',           // General / OBC / SC / ST
            'count:state',              // State-wise customers
            'count:entry_source'        // Web / Mobile / Employee / API
        ];
    }
    protected function defaultGroups(): array
    {
        return [
            'customer_type',        // Customer type chart
            'business_type',        // Business type chart
            'gender',               // Gender distribution
            'state',                // Location-wise
            'entry_source',         // Source-wise
            'created_at',           // Date-wise growth
            'next_date'             // Follow-up timeline
        ];
    }





	public function extraStats()
	{
    	return [];
	}

}
