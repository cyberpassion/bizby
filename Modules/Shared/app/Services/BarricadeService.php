<?php
namespace Modules\Shared\Services;

use Modules\Shared\Services\BarricadeRegistry;
use Modules\Shared\Services\BarricadeResourceRegistry;
use Illuminate\Support\Facades\Log;

class BarricadeService
{
    public static function evaluate(string $key): array
{
    $rules = BarricadeRegistry::get($key);

    $results = [];

    foreach ($rules as $rule) {
        if ($rule['type'] === 'exists') {
            if (!BarricadeResourceRegistry::exists(
                $rule['resource'],
                $rule['filter'] ?? []
            )) {
                $results[] = [
                    'allowed'    => false,
                    'restricted' => true,
                    'message'    => $rule['message'],
                    'action'     => $rule['action'] ?? null,
                ];
            }
        }
    }

    // If any failures → return array
    if (!empty($results)) {
        return $results;
    }

    // If all passed → keep single structure
    return ['allowed' => true];
}
}
