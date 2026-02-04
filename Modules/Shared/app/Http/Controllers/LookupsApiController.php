<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shared\Services\LookupRegistry;

class LookupsApiController extends Controller
{
    public function get($key)
    {
        $data = LookupRegistry::get($key);

        if ($data === null) {
            return response()->json([
                'status'  => false,
                'message' => "Lookup '{$key}' not found",
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | 🔐 Permission filtering for UI configs
        |--------------------------------------------------------------------------
        | Applies ONLY to keys like:
        |   student.ui.list_filters
        |   student.ui.sidebar_menu
        |   student.ui.single_actions
        |
        | Registry remains raw & global.
        | Filtering is per-request, per-user.
        */
        if ($this->isUiKey($key) && is_array($data)) {
            $data = $this->filterUiByPermission($data);
        }

        return response()->json([
            'status' => true,
            'key'    => $key,
            'data'   => $data,
        ]);
    }

    /**
     * Check whether the lookup key is a UI config key
     */
    protected function isUiKey(string $key): bool
    {
        return str_contains($key, '.ui.');
    }

    /**
     * Filter UI config array by permission
     */
    protected function filterUiByPermission(array $items): array
    {
        $user = auth()->user();

        return array_values(array_filter($items, function ($item) use ($user) {

            // If item is not an array, keep it (safety)
            if (!is_array($item)) {
                return true;
            }

            // If permission is not defined, allow by default
            if (!isset($item['permission'])) {
                return true;
            }

            // If user is missing (should not happen with sanctum)
            if (!$user) {
                return false;
            }

            return $user->can($item['permission']);
        }));
    }
}
