<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceBatchParticipant;

class AttendanceBatchParticipantApiController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Get batch participants
    |--------------------------------------------------------------------------
    */

    public function index($batchId)
    {
        $participants = AttendanceBatchParticipant::with('participant')
            ->where('batch_id', $batchId)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'data' => $participants
            ]
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Sync batch participants
    |--------------------------------------------------------------------------
    | The sent list becomes the exact participants of the batch
    */

    public function sync(Request $request, $batchId)
	{
    	$items = $request->all(); // because payload is an array
	    $tenantId = tenant()->id;

	    $incomingKeys = [];

	    foreach ($items as $item) {

    	    $incomingKeys[] = $item['type'].'-'.$item['id'];

	        AttendanceBatchParticipant::updateOrCreate(
    	        [
        	        'batch_id' => $batchId,
            	    'participant_id' => $item['id'],
                	'participant_type' => $item['type']
	            ],
    	        [
        	        'tenant_id' => $tenantId,
            	    'role' => $item['role'] ?? 'student'
            	]
    	    );
	    }

	    /*
    	|--------------------------------------------------------------------------
	    | Remove participants not present in request
    	|--------------------------------------------------------------------------
    	*/

	    $existing = AttendanceBatchParticipant::where('batch_id', $batchId)->get();

	    foreach ($existing as $row) {

	        $key = $row->participant_type.'-'.$row->participant_id;

    	    if (!in_array($key, $incomingKeys)) {
        	    $row->delete();
        	}
    	}

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Participants synced'
	    ]);
	}

    /*
    |--------------------------------------------------------------------------
    | Remove one participant
    |--------------------------------------------------------------------------
    */

    public function destroy($batchId, $participantId)
    {
        AttendanceBatchParticipant::where('batch_id', $batchId)
            ->where('id', $participantId)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Participant removed'
        ]);
    }
}