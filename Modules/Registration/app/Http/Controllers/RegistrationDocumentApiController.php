<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationDocument;
use App\Http\Controllers\Controller;

use Modules\Shared\Models\Upload;
use Illuminate\Support\Facades\Storage;

class RegistrationDocumentApiController extends Controller
{

	public function upload(Request $request, int $id)
	{
    	$request->validate([
        	'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx',
			'file_key' => 'required|string',
	        //'registration_type_document_id' => 'required|integer',
    	]);

	    // -------------------------------
    	// 🔹 1. Upload via shared logic
	    // -------------------------------
    	$file = $request->file('file');

	    $referenceType = 'registration';
    	$referenceId   = $id;
	    $fileKey       = $request->input('file_key');//$request->input('registration_type_document_id'); // or custom key

	    $folder = "bizby-app-data/tenant-" . ($request->header('X-Tenant-ID') ?? 'central')
    	    . "/{$referenceType}/{$referenceId}";

	    $filename = uniqid() . '_' . $file->getClientOriginalName();
    	$path = $folder . '/' . $filename;

	    Storage::disk('digitalocean_spaces')->putFileAs(
    	    $folder,
        	$file,
	        $filename,
    	    'public'
    	);

	    $url = Storage::disk('digitalocean_spaces')->url($path);

	    // -------------------------------
    	// 🔹 2. Save in uploads table
	    // -------------------------------
    	$upload = Upload::updateOrCreate(
        	[
            	'reference_type' => $referenceType,
	            'reference_id'   => $referenceId,
    	        'file_key'       => $fileKey,
        	],
        	[
            	'document_path' => $path,
	            'disk'          => 'digitalocean_spaces',
    	        'url'           => $url,
        	]
    	);

	    // -------------------------------
    	// 🔹 3. Attach to registration_documents
	    // -------------------------------
    	$doc = RegistrationDocument::updateOrCreate(
        	[
            	'registration_id' => $id,
				'name'		=> $fileKey,
	            //'registration_type_document_id' => $request->registration_type_document_id,
				'path'	=> $url
    	    ],
        	[
            	'upload_id' => $upload->id,
	            'status' => 'pending',
    	    ]
    	);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Document uploaded successfully.',
        	'data' => [
            	'upload' => $upload,
            	'document' => $doc,
            	'url' => $url,
        	]
	    ], 201);
	}

	public function getUploads(int $id)
	{
    	$documents = RegistrationDocument::with('uploads')
	        ->where('registration_id', $id)
    	    ->get();

	    return response()->json([
    	    'status' => 'success',
        	'data' => $documents
	    ]);
	}

}
