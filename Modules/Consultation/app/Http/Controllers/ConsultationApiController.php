<?php

namespace Modules\Consultation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Consultation\Services\ConsultationService;
use Modules\Consultation\Models\Consultation;
use Modules\Consultation\Formatters\ConsultationFormatter;
use Illuminate\Support\Facades\Validator;

class ConsultationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all consultations, maybe paginate
        $consultations = Consultation::paginate(10);

        return response()->json([
            'success' => true,
            'data' => $consultations
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'first_name'	=> 'required|string|max:255',
            'age'       	=> 'required|integer|min:0',
            'phone_number'	=> 'nullable|string|max:20'
        ]);

        // Create consultation
        $consultation = Consultation::create($validated);

        return response()->json([
            'success' => true,
            'data' => $consultation
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $consultation
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
	{
	    // Find the consultation
    	$consultation = Consultation::find($id);

	    if (!$consultation) {
    	    return response()->json([
        	    'success' => false,
            	'message' => 'Consultation not found'
	        ], Response::HTTP_NOT_FOUND);
    	}

	    // Get all fillable columns dynamically
    	$data = $request->only($consultation->getFillable());

	    // Validate only critical fields
    	$validator = Validator::make($data, [
        	'last_name' => 'sometimes|required|string|max:255',
	        'email'     => 'sometimes|required|email|unique:consultations,email,' . $id,
    	    'phone'     => 'nullable|string|max:20',
        	'remarks'   => 'nullable|string',
    	]);

	    if ($validator->fails()) {
    	    return response()->json([
        	    'success' => false,
            	'errors' => $validator->errors()
	        ], 422);
    	}

	    // Update consultation with all fields sent in the request
    	$consultation->update($data);

	    return response()->json([
    	    'success' => true,
        	'data' => $consultation
	    ], Response::HTTP_OK);
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $consultation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Consultation deleted successfully'
        ], Response::HTTP_OK);
    }
}
