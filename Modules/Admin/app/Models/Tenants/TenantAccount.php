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

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['status'];

    /**
     * Default attribute values
     */
    protected $attributes = [];

	protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }

	public function tenantusers()
	{
    	return $this->hasMany(TenantUser::class);
	}

	public function modules()
	{
    	return $this->hasMany(TenantModule::class, 'tenant_id');
	}

}