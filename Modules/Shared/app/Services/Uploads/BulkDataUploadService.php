<?php

namespace Modules\Shared\Services\Uploads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Shared\Jobs\Uploads\ProcessBulkDataCreateJob;
use Modules\Shared\Jobs\Uploads\ProcessBulkDataUpdateJob;

class BulkDataUploadService
{
    public function handle(Request $request)
    {
        $mode = $request->input('mode', 'create'); // default
        $file = $request->file('file');

        return match ($mode) {
            'create'  => $this->create($file, $request),
            'update'  => $this->update($file, $request),
            'preview' => $this->preview($file, $request),
            default   => throw ValidationException::withMessages([
                'mode' => 'Invalid mode'
            ]),
        };
    }

    protected function create($file, Request $request)
    {
        // validate file type
        $this->validateFile($file);

        // store temporarily
        $path = $file->store('bulk/data', 'local');

        // dispatch job (DO NOT process in request)
        Bus::dispatch(new ProcessBulkDataCreateJob(
            $path,
            $request->module
        ));

        return [
            'status' => 'queued',
            'mode' => 'create',
        ];
    }

    protected function update($file, Request $request)
    {
        $this->validateFile($file);

        $path = $file->store('bulk/data','local');

        Bus::dispatch(new ProcessBulkDataUpdateJob(
            $path,
            $request->module
        ));

        return [
            'status' => 'queued',
            'mode' => 'update',
        ];
    }

    protected function preview($file, Request $request)
    {
        $this->validateFile($file);

        // Read first 10 rows only (no DB write)
        return [
            'status' => 'preview',
            'rows' => $this->readPreviewRows($file),
        ];
    }

    protected function validateFile($file): void
    {
        Validator::make(
            ['file' => $file],
            ['file' => 'required|mimes:csv,xlsx,xls']
        )->validate();
    }

    protected function readPreviewRows($file): array
    {
        // pseudo code – you can plug maatwebsite/excel
        return [];
    }
}
