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
        return [
            'name' 			=> 'sometimes|required|string|max:255',
            'email'      	=> 'sometimes|required|email|unique:consultations,email,' . $id,
            'phone_number'	=> 'nullable|string|max:20',
            'remarks'    	=> 'nullable|string'
        ];
    }

	public function stats()
	{
		$totalConsultations = Consultation::count();
		$onlineConsultations = Consultation::where('channel', 'online')->count();
		$inPersonConsultations = Consultation::where('channel', 'in-person')->count();

		return response()->json([
			'total_consultations' => $totalConsultations,
			'online_consultations' => $onlineConsultations,
			'in_person_consultations' => $inPersonConsultations,
		]);
	}

}
