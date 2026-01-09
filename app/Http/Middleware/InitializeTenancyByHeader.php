<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class InitializeTenancyByHeader
{
    public function handle(Request $request, Closure $next)
    {
        $tenantId = $request->header('X-Tenant-ID');

        if (! $tenantId) {
            abort(400, 'X-Tenant-ID header missing');
        }

        $tenant = Tenant::find($tenantId);//print_r($tenant);

        if (! $tenant) {
            abort(404, 'Tenant not found');
        }

        tenancy()->initialize($tenant);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        tenancy()->end();
    }
}
