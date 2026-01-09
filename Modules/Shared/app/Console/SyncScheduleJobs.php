<?php

namespace Modules\Shared\Console;

use Illuminate\Console\Command;
use Modules\Shared\Services\Schedules\ScheduleJobRegistry;
use Modules\Shared\Models\Schedules\ScheduleJobRegistry as JobModel;

class SyncScheduleJobs extends Command
{
    protected $signature = 'schedules:sync-jobs';
    protected $description = 'Sync registered schedule jobs into database';

    public function handle(): int
    {
        $keys = ScheduleJobRegistry::all();

        foreach ($keys as $key) {
            JobModel::updateOrCreate(
                ['key' => $key],
                [
                    'description' => $this->guessDescription($key),
                    'is_active'   => true,
                ]
            );
        }

        // Disable orphaned DB jobs
        JobModel::whereNotIn('key', $keys)->update([
            'is_active' => false,
        ]);

        $this->info('Schedule jobs synced successfully.');

        return self::SUCCESS;
    }

    protected function guessDescription(string $key): string
    {
        return ucfirst(str_replace(':', ' → ', $key));
    }
}
