<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationCycle;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationCycleApiController extends SharedApiController
{
    protected function model()
    {
        return RegistrationCycle::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'registration_type_id' => 'required|exists:registration_types,id',
            'name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|int',
        ];
    }
}