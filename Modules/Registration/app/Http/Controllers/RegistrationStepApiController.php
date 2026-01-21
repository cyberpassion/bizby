<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationStep;
use App\Http\Controllers\Controller;

class RegistrationStepApiController extends Controller
{
    public function save(Request $request, $id)
    {
        return RegistrationStep::updateOrCreate(
            [
                'registration_id' => $id,
                'step' => $request->step
            ],
            [
                'data' => $request->data,
                'is_completed' => true
            ]
        );
    }
}
