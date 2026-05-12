<?php

namespace Modules\Admin\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

// Online Payments Specific
use Modules\Shared\Contracts\OnlinePayments\Payable;
use Modules\Shared\Contracts\OnlinePayments\FinalizePayment;

use Modules\Admin\Models\Tenants\Traits\TenantPayable;

class TenantAccount extends Model implements Payable, FinalizePayment
{
    use HasFactory;
	use TenantPayable; // Payable implementation trait

	protected $connection = 'central';

	protected $fillable = [
	    'name',
    	'domain',
	    'email',
    	'phone',
	    'plan',
    	'valid_till',
	    'api_key_hash',
    	'api_key_last_used_at',
	    'status',
    	'grace_till',
    	'settings',
	];

    /**
     * Default attribute values
     */
    protected $attributes = [];

	public function tenantusers()
	{
    	return $this->hasMany(TenantUser::class);
	}

	public function modules()
	{
    	return $this->hasMany(TenantModule::class, 'tenant_id');
	}

	public function addons()
	{
    	return $this->hasMany(TenantAddon::class, 'tenant_id');
	}

	public function getPurchasedModulesAttribute(): array
	{
    	return $this->modules()
	        ->where('is_active', true)
    	    ->pluck('module_key')
        	->toArray();
	}

	public function getPurchasedAddonsAttribute(): array
	{
    	return $this->addons()
	        ->where('is_active', true)
    	    ->pluck('addon_key')
        	->toArray();
	}

}