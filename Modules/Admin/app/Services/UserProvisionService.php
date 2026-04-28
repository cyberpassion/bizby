<?php

namespace Modules\Admin\Services;

use App\Models\User;
use Modules\Admin\Models\Tenants\TenantUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserProvisionService
{
    /*
    |--------------------------------------------------------------------------
    | Create Global User (shared)
    |--------------------------------------------------------------------------
    */
    public function createOrGetUser(array $data): User
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } else {
            // optional update
            $user->update([
                'name' => $data['name'],
            ]);
        }

        return $user;
    }

    /*
    |--------------------------------------------------------------------------
    | Create Tenant User (module)
    |--------------------------------------------------------------------------
    */
    public function createTenantUser(User $user, int $tenantId, int $roleId): TenantUser
    {
        return DB::transaction(function () use ($user, $tenantId, $roleId) {

            TenantUser::updateOrCreate(
                [
                    'tenant_id' => $tenantId,
                    'user_id'   => $user->id,
                ],
                [
                    'role_id'    => $roleId,
                    'type'       => 'module', // 🔒 enforced
                    'is_active'  => true,
                    'updated_at' => now(),
                ]
            );

            return TenantUser::where('tenant_id', $tenantId)
                ->where('user_id', $user->id)
                ->first();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Register Portal User
    |--------------------------------------------------------------------------
    */
    public function registerPortalUser(array $data): User
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'type'     => 'portal', // 🔒 enforced
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Tenant User
    |--------------------------------------------------------------------------
    */
    public function updateTenantUser(TenantUser $tenantUser, array $data)
    {
        $tenantUser->update($data);
        return $tenantUser;
    }

    /*
    |--------------------------------------------------------------------------
    | Deactivate Tenant User
    |--------------------------------------------------------------------------
    */
    public function deactivateTenantUser(TenantUser $tenantUser)
    {
        $tenantUser->update(['is_active' => false]);
        return true;
    }
}