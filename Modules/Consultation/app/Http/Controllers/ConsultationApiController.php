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
            'gender',
            'channel'
        ];
    }

	// Default Metrics
	protected function defaultMetrics(): array
	{
    	return ['total_records'];
	}

	// Default Sums
	protected function defaultAggregates(): array
	{
    	return [
        	'count:gender=M',
        	'count:gender=F',
	    ];
	}

	// Default grouping columns
	protected function defaultGroups(): array
	{
    	return ['gender'];
	}

}
