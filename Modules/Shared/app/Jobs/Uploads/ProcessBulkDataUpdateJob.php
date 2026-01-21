<?php

namespace Modules\Shared\Jobs\Uploads;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProcessBulkDataUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $path;
    public string $module;

    public int $timeout = 1200;
    public int $tries = 3;

    public function __construct(string $path, string $module)
    {
        $this->path = $path;
        $this->module = $module;
    }

    public function handle(): void
    {
        $fullPath = storage_path('app/' . $this->path);

        if (!file_exists($fullPath)) {
            Log::error("Bulk update file not found", [
                'path' => $this->path
            ]);
            return;
        }

        $handle = fopen($fullPath, 'r');
        $header = fgetcsv($handle);

        $batch = [];
        $chunkSize = 500;

        while (($row = fgetcsv($handle)) !== false) {
            $batch[] = array_combine($header, $row);

            if (count($batch) >= $chunkSize) {
                $this->updateChunk($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            $this->updateChunk($batch);
        }

        fclose($handle);

        Log::info('Bulk data update completed', [
            'module' => $this->module,
            'file'   => $this->path
        ]);
    }

    protected function updateChunk(array $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                $this->updateRow($row);
            }
        });
    }

    protected function updateRow(array $row): void
    {
        match ($this->module) {
            'student' => $this->updateStudent($row),
            'teacher' => $this->updateTeacher($row),
            default   => null,
        };
    }

    /**
     * REQUIRED COLUMN: id
     */
    protected function updateStudent(array $data): void
    {
        if (empty($data['id'])) {
            return; // or log error
        }

        DB::table('students')
            ->where('id', $data['id'])
            ->update([
                'name'       => $data['name'] ?? DB::raw('name'),
                'email'      => $data['email'] ?? DB::raw('email'),
                'phone'      => $data['phone'] ?? DB::raw('phone'),
                'updated_at' => now(),
            ]);
    }

    protected function updateTeacher(array $data): void
    {
        if (empty($data['id'])) {
            return;
        }

        DB::table('teachers')
            ->where('id', $data['id'])
            ->update([
                'name'       => $data['name'] ?? DB::raw('name'),
                'email'      => $data['email'] ?? DB::raw('email'),
                'phone'      => $data['phone'] ?? DB::raw('phone'),
                'updated_at' => now(),
            ]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('Bulk data update failed', [
            'module' => $this->module,
            'file'   => $this->path,
            'error'  => $e->getMessage()
        ]);
    }
}
