<?php

namespace Modules\Shared\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Schedules\ScheduleJobRegistry;

class ScheduleJobRegistryApiController extends Controller
{
    /**
     * List all available schedulable jobs
     */
    public function index(Request $request)
    {
        $module = $request->query('module', 'all');

        $query = ScheduleJobRegistry::query()
            ->where('is_active', true);

        // Filter by module (optional)
        if ($module !== 'all') {
            $query->where('module', $module);
        }

        $jobs = $query
            ->orderBy('module')
            ->orderBy('key')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $jobs,
        ]);
    }

    /**
     * Show single job definition (optional but recommended)
     */
    public function show(string $key)
    {
        $job = ScheduleJobRegistry::where('key', $key)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data'   => $job,
        ]);
    }
}
