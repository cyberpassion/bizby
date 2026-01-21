<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Modules\Shared\Services\ListService;
use Modules\Shared\Services\Uploads\BulkDataUploadService;
use Modules\Shared\Services\Uploads\BulkDocumentUploadService;

class UploadApiController extends Controller
{
    protected $moduleName = 'shared';
    protected string $disk = 'digitalocean_spaces';
	//protected string $disk = 'local';

	protected function rootFolder(Request $request): string
	{
    	return 'bizby-app-data/tenant-' . ($request->header('X-Tenant-ID') ?? 'central');
	}

    /**
     * Display a list of all uploads.
     */
    public function index(Request $request, ListService $listService)
    {
        $options = [];

        // IMPORTANT: use input() so it works for GET + POST
        $options['where'] = $request->except([
            'search', 'start', 'limit', 'sortBy', 'sortDir', 'page'
        ]);

        if ($request->filled('search')) {
            $options['search'] = $request->input('search');
            $options['searchColumns'] = ['file_key', 'reference_type'];
        }

        $options['start'] = (int) $request->input('start', 0);
        $options['limit'] = (int) $request->input('limit', 20);

        $options['sortBy']  = $request->input('sortBy', 'created_at');
        $options['sortDir'] = $request->input('sortDir', 'desc');

        $result = $listService->get('uploads', $options);

        return response()->json([
            'status'  => 'success',
            'message' => 'Records fetched successfully.',
            'data'    => $result
        ], Response::HTTP_OK);
    }

    /**
     * Upload a document
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'           => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx',
            'reference_type' => 'required|string',
            'reference_id'   => 'required|integer',
            'file_key'       => 'required|string',
        ]);

        $referenceType = $request->input('reference_type');
        $referenceId   = $request->input('reference_id');
        $fileKey       = $request->input('file_key');

        // Folder structure:
        $folder = "{$this->rootFolder($request)}/{$referenceType}/{$referenceId}";
		$filename = uniqid().'_'.$request->file('file')->getClientOriginalName();
		$path = $folder.'/'.$filename;

		try {
		    Storage::disk($this->disk)->putFileAs(
        		$folder,
		        $request->file('file'),
        		$filename,
		        'public'
    		);
		} catch (\Throwable $e) {
		    return response()->json([
        		'status' => 'error',
		        'message' => 'Upload failed',
    		], 500);
		}

		$url = Storage::disk($this->disk)->url($path);
		//$url = Storage::disk($this->disk)->temporaryUrl($path, now()->addMinutes(30)); // temporary URL
		//$url = null;

        // Save DB record
        $upload = Upload::updateOrCreate(
            [
                'reference_type' => $referenceType,
                'reference_id'   => $referenceId,
                'file_key'       => $fileKey,
            ],
            [
                'document_path' => $path,
                'disk'          => $this->disk,
                'url'           => $url,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded successfully.',
            'upload' => $upload,
            'url' => $url,
        ], 201);
    }

    /**
     * Delete upload
     */
    public function destroy($id)
    {
        $upload = Upload::find($id);

        if (!$upload) {
            return response()->json([
                'status' => 'error',
                'message' => 'Upload not found.'
            ], 404);
        }

        if ($upload->document_path) {
            Storage::disk($this->disk)->delete($upload->document_path);
        }

        $upload->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Upload deleted successfully.'
        ]);
    }

	public function bulkData(Request $request)
	{
    	$request->validate([
	        'module' => 'required|string',
        	'file'   => 'required|file',
	    ]);

	    return app(BulkDataUploadService::class)->handle($request);
	}

	public function bulkDocuments(Request $request)
	{
    	$request->validate([
	        'module' => 'required|string',
        	'file'   => 'required|file',
	    ]);

	    return app(BulkDocumentUploadService::class)->handle($request);
	}

}
