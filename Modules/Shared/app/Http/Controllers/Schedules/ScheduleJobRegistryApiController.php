<?php

namespace Modules\Shared\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Schedules\ScheduleJobRegistry;

class ScheduleJobRegistryApiController extends Controller
{
    public function index(Request $request)
    {
        $module = $request->query('module');

        $query = ScheduleJobRegistry::where('is_active', true);

        if ($module && $module !== 'all') {
            $query->where('module', $module);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->orderBy('module')->orderBy('key')->get()
        ]);
    }
}
