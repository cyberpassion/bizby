<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationType;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationTypeApiController extends SharedApiController
{
    protected function model()
    {
        return RegistrationType::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:registration_types,code,' . $id,
            'is_active' => 'boolean',
        ];
    }
}