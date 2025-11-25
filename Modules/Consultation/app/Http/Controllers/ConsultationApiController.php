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
            'first_name' => 'sometimes|required|string|max:255',
            'last_name'  => 'sometimes|required|string|max:255',
            'email'      => 'sometimes|required|email|unique:consultations,email,' . $id,
            'phone'      => 'nullable|string|max:20',
            'remarks'    => 'nullable|string'
        ];
    }
}
