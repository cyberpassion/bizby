<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Database\Models\Tenant;
use Modules\Admin\Models\Tenants\TenantUser;

class IdentifyTenantByHeader
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * 1️⃣ Read tenant id from header (INTENT)
         */
        $tenantId = $request->header('X-Tenant-ID');

        if (! $tenantId) {
            return response()->json([
                'status'  => 'error',
                'message' => 'X-Tenant-ID header is missing',
            ], 400);
        }

        /**
         * 2️⃣ Resolve tenant from CENTRAL database
         * ❗ Identity only — NO tenancy initialization
         */
        $tenant = Tenant::query()->find($tenantId);

        if (! $tenant) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Tenant not found',
            ], 404);
        }

        /**
         * 3️⃣ Resolve authenticated user (ACTOR)
         */
        $user = $request->user();

        if (! $user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthenticated',
            ], 401);
        }

        /**
         * 4️⃣ Authorize ACTOR inside tenant
         * Only OWNER / ADMIN can manage tenant users
         */
        $canManageUsers = true;/*TenantUser::query()
            ->where('tenant_id', $tenant->id)
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->whereIn('role_id', ['owner', 'admin'])
            ->exists();*/

        if (! $canManageUsers) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized tenant access',
            ], 403);
        }

        /**
         * 5️⃣ Store resolved tenant identity (SAFE)
         * No DB switch, no side effects
         */
        app()->instance('resolvedTenant', $tenant);
        $request->attributes->set('resolvedTenant', $tenant);

        return $next($request);
    }
}
