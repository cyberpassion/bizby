<?php

namespace Modules\Shared\Jobs\Uploads;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProcessBulkDataCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $path;
    public string $module;

    public int $timeout = 1200;
    public int $tries = 3;

    /**
     * Define allowed columns per module (table)
     * This prevents CSV header injection
     */
    protected array $allowedColumns = [];

    public function __construct(string $path, string $module)
    {
        $this->path = $path;
        $this->module = $module;
    }

    public function handle(): void
    {
		$this->allowedColumns = config('shared.bulk_upload.tables', []);
        $fullPath = Storage::disk('local')->path($this->path);

        if (!file_exists($fullPath)) {
            Log::error("Bulk upload file not found", [
                'path' => $this->path,
                'resolved' => $fullPath,
            ]);
            return;
        }

        $handle = fopen($fullPath, 'r');

        if ($handle === false) {
            Log::error("Failed to open bulk upload file", [
                'path' => $this->path,
            ]);
            return;
        }

        $header = fgetcsv($handle);

        if (!$header) {
            Log::error("Bulk upload file is empty or invalid", [
                'path' => $this->path,
            ]);
            fclose($handle);
            return;
        }

        $batch = [];
        $chunkSize = 500;

        while (($row = fgetcsv($handle)) !== false) {
            $rowData = array_combine($header, $row);

            if (!$rowData) {
                continue;
            }

            $batch[] = $rowData;

            if (count($batch) >= $chunkSize) {
                $this->insertChunk($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            $this->insertChunk($batch);
        }

        fclose($handle);

        // Cleanup temp file
        Storage::disk('local')->delete($this->path);

        Log::info('Bulk data upload completed', [
            'module' => $this->module,
            'file' => $this->path
        ]);
    }

    protected function insertChunk(array $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                $this->insertRow($row);
            }
        });
    }

    protected function insertRow(array $row): void
    {
        $config = $this->allowedColumns[$this->module];

		$data = array_intersect_key($row, array_flip($config['columns']));

		// convert empty to null
		$data = array_map(fn($v) => $v === '' ? null : $v, $data);

		// required check
		foreach ($config['required'] as $field) {
	    	if (empty($data[$field])) {
    	    	return; // skip row
    		}
		}

		// defaults
		foreach ($config['defaults'] as $field => $value) {
    		$data[$field] ??= $value;
		}

		$data['created_at'] = now();
		DB::table($this->module)->insert($data);

    }

    public function failed(\Throwable $e): void
    {
        Log::error('Bulk data upload failed', [
            'module' => $this->module,
            'file' => $this->path,
            'error' => $e->getMessage()
        ]);
    }
}
