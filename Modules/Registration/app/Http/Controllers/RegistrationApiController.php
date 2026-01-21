<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\Registration;
use App\Http\Controllers\Controller;

class RegistrationApiController extends Controller
{
    public function create(Request $request)
    {
        return Registration::create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
            'meta' => config("registration.types.{$request->type}")
        ]);
    }

    public function my()
    {
        return Registration::where('user_id', auth()->id())
            ->with('steps', 'documents', 'payments')
            ->latest()
            ->get();
    }

    public function submit($id)
    {
        $reg = Registration::findOrFail($id);

        $reg->update([
            'status' => 'submitted',
            'submitted_at' => now()
        ]);

        return $reg;
    }
}
