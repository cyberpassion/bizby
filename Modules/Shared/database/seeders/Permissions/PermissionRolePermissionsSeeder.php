<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('permission_roles')->get()->keyBy('slug');
		$permissions = DB::table('permission_permissions')->get();

		foreach ($permissions as $permission) {

		    $pid = $permission->id;
		    $slug = $permission->slug;
    		$moduleName = $permission->module;

			if (!isset($roles['owner'])) return;

            // 🔥 OWNER → everything
            DB::table('permission_role_permissions')->updateOrInsert([
                'role_id' => $roles['owner']->id,
                'permission_id' => $pid,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 🔥 ADMIN → everything except billing/core
            if (!str_contains($slug, 'plans') &&
                !str_contains($slug, 'subscriptions')) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['admin']->id,
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 🔥 MANAGER → view + create + update
            if (preg_match('/\.(view|create|update)$/', $slug)) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['manager']->id,
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 🔥 STAFF → view + create
            if (preg_match('/\.(view|create)$/', $slug)) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['staff']->id,
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 🔥 VIEWER → only view
            if (str_ends_with($slug, '.view')) {

                DB::table('permission_role_permissions')->updateOrInsert([
                    'role_id' => $roles['viewer']->id,
                    'permission_id' => $pid,
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

		    // 🔥 MODULE USER ROLES (META-DRIVEN)
			foreach ($roles as $role) {

				// ✅ FORCE: portal roles always get access.portal
			    if ($role->type === 'portal' && $slug === 'access.portal') {

			        DB::table('permission_role_permissions')->updateOrInsert([
			            'role_id' => $role->id,
        			    'permission_id' => $pid,
		    	    ], [
        			    'created_at' => now(),
            			'updated_at' => now(),
	        		]);

		        	continue; // skip further checks for this permission
    			}

			    if (!$role->meta) continue;

			    $meta = json_decode($role->meta, true);

			    if (!$meta) continue;

			    $modules = $meta['modules'] ?? [];
			    $extraModules = $meta['extra_modules'] ?? [];

			    $allowedModules = array_merge($modules, $extraModules);

			    // skip if no module defined
			    if (empty($allowedModules)) continue;

			    // check if permission belongs to allowed module
			    if (in_array($moduleName, $allowedModules, true)) {

			        // 🔥 OPTIONAL: restrict portal users
			        if ($role->type === 'portal') {
					    if (!str_ends_with($slug, '.view') && $slug !== 'access.portal') {
					        continue;
    					}
					}

		        	DB::table('permission_role_permissions')->updateOrInsert([
        		    	'role_id' => $role->id,
	            		'permission_id' => $pid,
			        ], [
        			    'created_at' => now(),
            			'updated_at' => now(),
        			]);
    			}
			}

            // ❌ CUSTOM → no auto permissions
        }
    }
}