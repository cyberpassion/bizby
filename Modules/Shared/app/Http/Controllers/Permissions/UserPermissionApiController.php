<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shared\Services\Permissions\PermissionService;

class UserPermissionApiController extends Controller
{
    public function __construct(
        protected PermissionService $permissions
    ) {}

    /**
     * -------------------------------------------------
     * LIST USER PERMISSIONS
     * -------------------------------------------------
     */
    public function index(
        int $userId,
        int $tenantId
    ) {

        $user = User::findOrFail($userId);

        $permissions = $this->permissions
            ->getTenantPermissions(
                $user,
                $tenantId
            )
            ->pluck('slug')
            ->values();

        return response()->json([
            'status' => 'success',

            'data' => [

                'tenant_id' => $tenantId,

                'user_id' => $userId,

                'permissions' => $permissions,
            ],
        ]);
    }

    /**
     * -------------------------------------------------
     * ASSIGN DIRECT PERMISSIONS
     * -------------------------------------------------
     */
    public function assign(
        Request $request,
        int $userId
    ) {

        $request->validate([
            'permission_ids' => 'required|array',
        ]);

        $this->permissions->assignDirectPermissions(
            $userId,
            tenant()->id,
            $request->permission_ids
        );

        return response()->json([
            'message' => 'User permissions assigned',
        ]);
    }

    /**
     * -------------------------------------------------
     * REVOKE DIRECT PERMISSIONS
     * -------------------------------------------------
     */
    public function revoke(
        Request $request,
        int $userId
    ) {

        $this->permissions->revokeDirectPermissions(
            $userId,
            tenant()->id,
            $request->permission_ids
        );

        return response()->json([
            'message' => 'User permissions removed',
        ]);
    }
}
