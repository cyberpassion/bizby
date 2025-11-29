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
        return [
            'name' 			=> 'sometimes|required|string|max:255',
            'email'      	=> 'sometimes|required|email|unique:consultations,email,' . $id,
            'phone_number'	=> 'nullable|string|max:20',
            'remarks'    	=> 'nullable|string'
        ];
    }

	public function stats()
	{

		// Overview
		$totalConsultations = Consultation::count();
		$onlineConsultations = Consultation::where('channel', 'online')->count();
		$inPersonConsultations = Consultation::where('channel', 'in-person')->count();

		$overview = [
			'total_consultations' => $totalConsultations,
			'online_consultations' => $onlineConsultations,
			'in_person_consultations' => $inPersonConsultations,
		];

		// Chart data - Consultations by mode
		// Generate multiple charts easily
		$charts = [
    		'channel' => $this->getChartCounts('channel'),
    		'consultation_type' => $this->getChartCounts('consultant_type'),
		    'status' => $this->getChartCounts('status'),   // example
		];

		$data = array_merge(["overview" => $overview], ["charts" => $charts]);

		return response()->json([
            'status' => 'success',
            'message' => 'Record fetched successfully.',
            'data' => $data
        ], Response::HTTP_OK);
	}

	public function getChartCounts($field) {
	    return Consultation::select($field)
    	    ->selectRaw('COUNT(*) as total')
        	->groupBy($field)
        	->pluck('total', $field)
        	->toArray();
	}

}
