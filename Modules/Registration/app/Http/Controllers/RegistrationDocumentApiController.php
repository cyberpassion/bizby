<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationDocument;
use App\Http\Controllers\Controller;

class RegistrationDocumentApiController extends Controller
{
    public function upload(Request $request, $id)
    {
        $path = $request->file('file')->store('registrations');

        return RegistrationDocument::create([
            'registration_id' => $id,
            'name' => $request->name,
            'path' => $path
        ]);
    }
}
