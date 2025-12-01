<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Upload;

class UploadController extends Controller
{
    protected $moduleName = 'shared';

	/**
	 * Display a list of all uploads.
	 */
	public function index(Request $request)
	{
    	// Fetch all uploads (you can add filtering later if needed)
	    $uploads = Upload::orderBy('created_at', 'desc')->get();

	    return response()->json([
            	'status' => 'success',
            	'uploads' => $uploads
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
		    'reference_id'  => 'required|integer',    // referenceId
    		'file_key'      => 'required|string',     // fileKey
		]);

		$referenceId = $request->input('reference_id');
		$fileKey = $request->input('file_key');

		// Store file in storage/app/public/uploads/{referenceId}
		$path = $request->file('file')->store("uploads/{$referenceId}", 'public');

		// Find existing upload or create a new one
		$upload = Upload::updateOrCreate(
    		[
		        'reference_id' => $referenceId,
        		'file_key'     => $fileKey,
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
}
