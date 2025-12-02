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
			'gender'		=>	'sometimes|required|string|max:255',
            'email'      	=> 'sometimes|required|email|unique:consultations,email,' . $id,
            'phone'			=> 'nullable|string|max:20',
        ];
    }

	public function stats()
	{

		// Overview
		$total = Consultation::count();
		$males = Consultation::where('gender', 'M')->count();
		$females = Consultation::where('gender', 'F')->count();

		$overview = [
			'total_consultations' => $total,
			'male_consultations' => $males,
			'female_consultations' => $females,
			'revenue_total' => 500000
		];

		// Chart data - Consultations by mode
		// Generate multiple charts easily
		$charts = [
    		'channel' => $this->getChartCounts('channel')
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
