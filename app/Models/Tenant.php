<?php

namespace App\Models;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

	public function modules()
	{
    	return $this->hasMany(
	        \Modules\Admin\Models\Tenants\TenantModule::class, // adjust if needed
    	    'tenant_id'
    	);
	}

	public function addons()
	{
    	return $this->hasMany(
	        \Modules\Admin\Models\Tenants\TenantAddon::class,
    	    'tenant_id'
    	);
	}

}