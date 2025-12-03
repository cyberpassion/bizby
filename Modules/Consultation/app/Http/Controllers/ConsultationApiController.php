<?php

namespace Modules\Consultation\Http\Controllers;

use Modules\Consultation\Models\Consultation;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Response;

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

	public function extraStats()
	{
    	return [
       		'male_consultations' => Consultation::where('gender', 'M')->count(),
        	'female_consultations' => Consultation::where('gender', 'F')->count(),
        	'revenue_total' => 500000
    	];
	}

}
