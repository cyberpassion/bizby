<?php
namespace Modules\Shared\Services;

use Modules\Shared\Services\BarricadeRegistry;
use Modules\Shared\Services\BarricadeResourceRegistry;
use Illuminate\Support\Facades\Log;


class BarricadeService
{
    public static function evaluate(string $key): array
    {
		// BarricadeService::evaluate
        $rules = BarricadeRegistry::get($key);

        foreach ($rules as $rule) {
            if ($rule['type'] === 'exists') {
                if (!BarricadeResourceRegistry::exists(
                    $rule['resource'],
                    $rule['filter'] ?? []
                )) {
                    return [
                        'allowed'    	=> false,
                        'restricted'	=> true,
                        'message'  		=> $rule['message'],
                        'action'   		=> $rule['action'] ?? null,
                    ];
                }
            }
        }

        return ['allowed' => true];
    }
}
