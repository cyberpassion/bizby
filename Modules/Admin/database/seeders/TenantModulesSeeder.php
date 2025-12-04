<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TenantModulesSeeder extends Seeder
{
    public function run()
	{
    	$modules = [
        	[
	            'tenant_id' => 1,
    	        'module_key' => 'student',
        	    'module_name' => 'Student Management',
            	'activated_at' => Carbon::now()->subDays(50),
	            'deactivated_at' => null,
    	        'is_paid' => true,
        	    'price' => 5000,
            	'valid_till' => Carbon::now()->addYear(),
	            'config' => json_encode(['enable_attendance' => true]),
    	        'created_at' => now(),
        	    'updated_at' => now(),
	        ],
    	    [
        	    'tenant_id' => 1,
	            'module_key' => 'finance',
    	        'module_name' => 'Finance Management',
        	    'activated_at' => Carbon::now()->subDays(30),
            	'deactivated_at' => null, // FIXED
	            'is_paid' => true,
    	        'price' => 3000,
        	    'valid_till' => Carbon::now()->addYear(),
            	'config' => json_encode([]),
	            'created_at' => now(),
    	        'updated_at' => now(),
        	],
	        [
    	        'tenant_id' => 2,
        	    'module_key' => 'student',
            	'module_name' => 'Student Management',
	            'activated_at' => Carbon::now()->subDays(10),
    	        'deactivated_at' => null, // FIXED
        	    'is_paid' => true,
            	'price' => 2000,
	            'valid_till' => Carbon::now()->addMonths(6),
    	        'config' => json_encode(['enable_attendance' => false]),
        	    'created_at' => now(),
            	'updated_at' => now(),
        	],
    	];

	    DB::table('tenant_modules')->insert($modules);
	}

}