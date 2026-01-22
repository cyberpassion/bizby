<?php

namespace Modules\Shared\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission, ?string $scope = null)
    {
        if (!can($permission, $scope)) {
            return response()->json([
                'message' => 'Permission denied'
            ], 403);
        }

        return $next($request);
    }
}
