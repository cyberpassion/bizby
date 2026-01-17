<?php

namespace Modules\Shared\Console;

use Illuminate\Console\Command;
use Modules\Shared\Services\Schedules\ScheduleJobRegistry;
use Modules\Shared\Models\Schedules\ScheduleJobRegistry as JobModel;

class SyncScheduleJobs extends Command
{
    protected $signature = 'schedules:sync-jobs {--force : Update existing jobs}';
    protected $description = 'Sync registered schedule jobs into database';

    public function handle(): int
    {
        $jobs = ScheduleJobRegistry::all(); // now returns DETAILS

        $keys = [];

        foreach ($jobs as $key => $job) {
            $keys[] = $key;

            JobModel::updateOrCreate(
                ['key' => $key],
                [
                    'module'        => $job['module'] ?? null,
                    'job_class'     => $job['class'],
					'module'        => $job['module'] ?? null,
					'name'          => $job['name'],
                    'description'   => $job['description'],
                    'default_config'=> $job['defaults'] ?? [],
                    'allowed_frequencies' => $job['allowed_frequencies'] ?? [],
                    'is_active'     => true,
                ]
            );
        }

        // Disable orphaned jobs (module removed)
        JobModel::whereNotIn('key', $keys)->update([
            'is_active' => false,
        ]);

        $this->info('✔ Schedule jobs synced successfully.');

        return self::SUCCESS;
    }
}
