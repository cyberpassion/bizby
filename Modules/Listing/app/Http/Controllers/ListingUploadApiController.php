<?php

namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Shared\Models\Upload;

class ListingUploadApiController extends Controller
{
    public function upload(Request $request, int $id)
    {
        $request->validate([
            'file' => 'required|file|max:10240|mimes:jpg,jpeg,png,webp,pdf',
            'file_key' => 'required|string',
        ]);

        // ------------------------------------------------
        // FILE
        // ------------------------------------------------

        $file = $request->file('file');

        $referenceType = 'listing';

        $referenceId = $id;

        $fileKey = $request->input('file_key');

        // ------------------------------------------------
        // STORAGE PATH
        // ------------------------------------------------

        $folder =
            'bizby-app-data/tenant-'.
            ($request->header('X-Tenant-ID') ?? 'central').
            "/{$referenceType}/{$referenceId}";

        $filename = uniqid().'_'.$file->getClientOriginalName();

        $path = $folder.'/'.$filename;

        // ------------------------------------------------
        // UPLOAD
        // ------------------------------------------------

        Storage::disk('digitalocean_spaces')->putFileAs(
            $folder,
            $file,
            $filename,
            'public'
        );

        $url = Storage::disk('digitalocean_spaces')->url($path);

        // ------------------------------------------------
        // SAVE CENTRAL UPLOAD
        // ------------------------------------------------

        $upload = Upload::updateOrCreate(
            [
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'file_key' => $fileKey,
            ],
            [
                'document_path' => $path,
                'disk' => 'digitalocean_spaces',
                'url' => $url,
            ]
        );

        // ------------------------------------------------
        // RESPONSE
        // ------------------------------------------------

        return response()->json([
            'status' => 'success',

            'message' => 'File uploaded successfully.',

            'data' => [
                'id' => $upload->id,

                'url' => $url,

                'file_key' => $fileKey,

                'path' => $path,
            ],
        ], 201);
    }

    public function getUploads(int $id)
    {
        $uploads = Upload::where('reference_type', 'listing')
            ->where('reference_id', $id)
            ->get();

        return response()->json([
            'status' => 'success',

            'data' => $uploads,
        ]);
    }
}
