<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Database\Models\Tenant;

class IdentifyTenantByHeader
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * 1️⃣ Read tenant id from header
         */
        $tenantId = $request->header('X-Tenant-ID');

        if (! $tenantId) {
            return response()->json([
                'status'  => 'error',
                'message' => 'X-Tenant-ID header is missing',
            ], 400);
        }

        /**
         * 2️⃣ Resolve tenant (central DB)
         */
        $tenant = Tenant::query()->find($tenantId);

        if (! $tenant) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Tenant not found',
            ], 404);
        }

        /**
         * 3️⃣ Store tenant in container + request
         */
        app()->instance('resolvedTenant', $tenant);
        $request->attributes->set('resolvedTenant', $tenant);

        return $next($request);
    }
}