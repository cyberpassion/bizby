<?php

namespace Modules\Admin\Services\Tenants;

use Modules\Admin\Models\Tenants\TenantAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stancl\Tenancy\Facades\Tenancy;

class TenantAdminService
{
    public function createCentralAdmin(TenantAccount $tenant): void
    {
        // Ensure central DB context
        Tenancy::end();

        $central = config('tenancy.database.central_connection');

		logger()->info('Creating Central Admin', ['file' => __FILE__,'line' => __LINE__,'method' => __METHOD__,]);

        DB::connection($central)->transaction(function () use ($tenant, $central) {

            // 1️⃣ Create / Update central user
			//$password = Str::random(16);
			$password = 'password';
            $userId = DB::connection($central)
                ->table('users')
                ->updateOrInsert(
                    ['email' => $tenant->email],
                    [
                        'name'        => $tenant->name,
                        'password'    => Hash::make($password),
                        'updated_at'  => now(),
                        'created_at'  => now(),
                    ]
                );

            // Fetch user id (updateOrInsert doesn't return it)
            $user = DB::connection($central)
                ->table('users')
                ->where('email', $tenant->email)
                ->first();

            // 2️⃣ Map user to tenant with role
            DB::connection($central)
                ->table('tenant_users')
                ->updateOrInsert(
                    [
                        'user_id'   => $user->id,
                        'tenant_id' => $tenant->id,
                    ],
                    [
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );

			// 3️⃣ Assign OWNER role
			$ownerRole = $this->getDefaultOwnerRole();
			DB::connection($central)
		    	->table('permission_user_roles')
    			->updateOrInsert(
        		[
            		'user_id' => $user->id,
	            	'role_id' => $ownerRole, // OWNER ROLE ID
	    	    ],
    	    	[
        	    	'updated_at' => now(),
	        	    'created_at' => now(),
    	    	]
    		);

        });
    }
	protected function getDefaultOwnerRole()
	{
    	$role = DB::table('permission_roles')
    	    ->where('slug', 'owner') // 🔥 define this
        	->first();

	    if (!$role) {
    	    abort(500, 'Default portal role not configured');
    	}

	    return $role->id;
	}
}
