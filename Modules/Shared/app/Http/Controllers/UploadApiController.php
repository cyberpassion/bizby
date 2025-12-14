<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Upload;
use Illuminate\Support\Facades\Storage;

use Modules\Shared\Services\ListService;

class UploadApiController extends Controller
{
    protected $moduleName = 'shared';

	/**
	 * Display a list of all uploads.
	 */
	public function index(Request $request, ListService $listService)
	{
    	$options = [];

	    // 1. Exact filters: take all query parameters as where filters
    	$options['where'] = $request->query(); // dynamic filters

	    // 2. Optional: search
    	if ($request->has('search')) {
        	$options['search'] = $request->query('search');
	        // define which columns to search
    	    $options['searchColumns'] = ['file_key', 'reference_type']; 
    	}

	    // 3. Pagination
    	$options['start'] = $request->query('start', 0);
	    $options['limit'] = $request->query('limit', 20);

	    // 4. Sorting
	    $options['sortBy']  = $request->query('sortBy', 'created_at');
    	$options['sortDir'] = $request->query('sortDir', 'desc');

	    $result = $listService->get('uploads', $options);

	    return response()->json([
    	    'status' => 'success',
        	'total'  => $result['total'],
        	'uploads'=> $result['list'],
    	]);

	}

    /**
     * Show the uploaded file info for a given referenceId and fileKey
     */
    public function show($referenceId, $fileKey)
	{
    	// Find the upload record, if any
    	$upload = Upload::where('reference_id', $referenceId)
                    ->where('file_key', $fileKey)
                    ->first();

	    // Pass $referenceId and $fileKey to the view
    	return view("{$this->moduleName}::upload", compact('upload', 'referenceId', 'fileKey'));
	}

    /**
     * Upload a document for a given referenceId and fileKey
     */
    public function store(Request $request)
    {
        // Validate inputs
		$request->validate([
    		'file'          => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx',
			'reference_type'=> 'required|string',	// referenceType
		    'reference_id'  => 'required|integer',  // referenceId
    		'file_key'      => 'required|string',   // fileKey
		]);

		$referenceType = $request->input('reference_type');
		$referenceId = $request->input('reference_id');
		$fileKey = $request->input('file_key');

		// Store file in storage/app/public/uploads/{$referenceType}/{referenceId}
		$path = $request->file('file')->store("uploads/{$referenceType}/{$referenceId}", 'public');

		// Find existing upload or create a new one
		$upload = Upload::updateOrCreate(
    		[
				'reference_type'=> $referenceType,
		        'reference_id' 	=> $referenceId,
        		'file_key'     	=> $fileKey,
    		],
		    [
        		'document_path' => $path,
   			]
		);

		// Return JSON for API calls, redirect for web
		if ($request->expectsJson()) {
		    return response()->json([
        		'status' => 'success',
		        'message' => 'File uploaded successfully.',
        		'upload' => $upload,
		        'path' => $path
		    ], 201);
		}

		return back()->with('success', 'File uploaded successfully.');

    }
	
	public function destroy($id)
	{
    	$upload = Upload::find($id);

	    if (!$upload) {
    	    return response()->json([
        	    'status' => 'error',
            	'message' => 'Upload not found.'
	        ], 404);
    	}

	    // Delete file if exists
    	if ($upload->document_path && Storage::disk('public')->exists($upload->document_path)) {
        	Storage::disk('public')->delete($upload->document_path);
    	}

	    // Delete DB record
    	$upload->delete();

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Upload deleted successfully.'
    	]);
	}

}
