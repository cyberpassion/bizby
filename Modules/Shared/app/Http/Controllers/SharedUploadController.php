<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Shared\Services\SharedService;
use Modules\Shared\Models\Shared;
use Modules\Shared\Formatters\SharedFormatter;
use Modules\Shared\Services\SharedResourceService;

use Illuminate\Support\Facades\Storage;

class SharedUploadController extends Controller
{

	protected $service;
	protected $moduleName = 'shared';

	public function show($id)
	{
    	$upload = Shared::findOrFail($id);
    	return view("{$this->moduleName}::upload", compact($this->moduleName));
	}

	/**
     * Upload a document for a upload
     */
    public function store(Request $request, $id)
    {
        // Find the upload
        $upload = Shared::findOrFail($id);

        // Validate the incoming file
        $request->validate([
            'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx', // 10 MB limit
        ]);

        // Store the file
        $path = $request->file('file')->store("uploads/{$id}", 'public');

        // Optionally, save the file path to the upload
        $upload->document_path = $path;
        $upload->save();

        // Return response
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'File uploaded successfully',
                'path' => $path
            ], 201);
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

}
