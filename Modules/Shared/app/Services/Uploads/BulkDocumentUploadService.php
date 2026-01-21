<?php

namespace Modules\Shared\Services\Uploads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use ZipArchive;

class BulkDocumentUploadService
{
    protected string $disk = 'digitalocean_spaces';

    // turn off later
    protected bool $debug = false;

    public function handle(Request $request)
    {
        $request->validate([
            'file'   => 'required|file',
            'module' => 'required|string',
        ]);

        $file = $request->file('file');

        if ($file->getClientOriginalExtension() === 'zip') {
            return $this->handleZip($file, $request->module, $request->file_key);
        }

        return $this->handleSingle($file, $request->module, $request->file_key);
    }

    protected function handleZip($zip, string $module, string $fileKey)
    {
        $zipPath = $zip->store('bulk/documents', 'local');

        $extractPath = storage_path('app/tmp/' . uniqid());
        mkdir($extractPath, 0777, true);

        $zipArchive = new ZipArchive;
        $zipArchive->open(Storage::disk('local')->path($zipPath));
        $zipArchive->extractTo($extractPath);
        $zipArchive->close();

        if ($this->debug) {
            Log::info('ZIP extracted', ['path' => $extractPath]);
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($extractPath)
        );

        foreach ($iterator as $file) {
            if ($file->isDir()) continue;

            $name = $file->getFilename();
            $path = $file->getPathname();

            // debug log
            if ($this->debug) {
                Log::info('Iterating file', [
                    'name' => $name,
                    'path' => $path,
                ]);
            }

            // skip macOS junk
            if (
                str_starts_with($name, '._') ||
                $name === '.DS_Store' ||
                str_contains($path, '__MACOSX')
            ) {
                if ($this->debug) {
                    Log::info('Skipping macOS junk', ['file' => $name]);
                }
                continue;
            }

            $this->processFile($path, $module, $fileKey);
        }

        // cleanup zip
        Storage::disk('local')->delete($zipPath);

        // optional cleanup extracted folder
        \Illuminate\Support\Facades\File::deleteDirectory($extractPath);

        return ['status' => 'processed'];
    }

    protected function handleSingle($file, string $module, string $fileKey)
    {
        if ($this->debug) {
            Log::info('Processing single file', [
                'name' => $file->getClientOriginalName(),
                'tmp' => $file->getPathname(),
            ]);
        }

        $this->processFile($file->getPathname(), $module, $fileKey);

        return ['status' => 'processed'];
    }

    protected function processFile(string $filePath, string $module, string $fileKey)
	{
    	if (!file_exists($filePath)) return;

	    $filename = basename($filePath);
    	$info = pathinfo($filename);

	    if (!is_numeric($info['filename'])) return;

	    $referenceId = (int) $info['filename'];

	    $storedPath = Storage::disk($this->disk)->putFile(
    	    "uploads/{$module}",
        	new \Illuminate\Http\File($filePath)
	    );

	    DB::table('uploads')->updateOrInsert(
    	    [
        	    'reference_type' => $module,
            	'reference_id'   => $referenceId,
            	'file_key'       => $fileKey,
	        ],
    	    [
        	    'document_path' => $storedPath,
            	'disk'          => $this->disk,
            	'updated_at'    => now(),
            	'created_at'    => now(),
        	]
    	);
	}

}
