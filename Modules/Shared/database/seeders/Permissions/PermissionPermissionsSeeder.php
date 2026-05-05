<?php

namespace Modules\Shared\Database\Seeders\Permissions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Modules\Shared\Models\Permissions\PermissionPermission;

class PermissionPermissionsSeeder extends Seeder
{
    public function run(): void
	{
    	$modulesPath = base_path('Modules');
	    $permissions = [];

	    foreach (File::directories($modulesPath) as $modulePath) {

	        $moduleName = basename($modulePath);

	        $currentlyAllowed = [
    	        'Asset',
        	    'Incident',
            	'Center',
	            'Maintenance',
    	        'Product',
        	    'Inventory',
            	'Vendor',
	            'Employee',
    	        'Note',
        	    'Consultation',
            	'Registration',
	            'Listing',
    	        'Attendance',
        	    'Lead'
        	];

	        if (!in_array($moduleName, $currentlyAllowed)) {
    	        continue;
        	}

	        $configPath = $modulePath . '/config/ui/' . $moduleName . '.php';

	        if (!file_exists($configPath)) continue;

	        $config = require $configPath;

	        $this->extractPermissions($config, $permissions);
    	}

	    // ✅ ADD SYSTEM PERMISSIONS HERE
    	$systemPermissions = [
        	'access.admin',
	        'access.portal',
    	];

	    $permissions = array_merge($permissions, $systemPermissions);

	    // cleanup
    	$permissions = array_unique(array_filter($permissions));

	    foreach ($permissions as $slug) {

	        [$module, $operation] = $this->parseSlug($slug);

	        PermissionPermission::updateOrCreate(
    	        ['slug' => $slug],
        	    [
            	    'module' => $module,
                	'operation' => $operation,
	                'scope' => 'global',
    	            'guard' => 'api',
        	    ]
        	);
    	}
	}

    private function extractPermissions(array $data, array &$permissions)
    {
        foreach ($data as $item) {

            if (is_array($item)) {

                if (isset($item['permission'])) {
                    $permissions[] = $item['permission'];
                }

                $this->extractPermissions($item, $permissions);
            }
        }
    }

    private function parseSlug(string $slug)
    {
        $parts = explode('.', $slug);

        return [
            $parts[0] ?? 'general',
            end($parts) ?? 'view'
        ];
    }
}