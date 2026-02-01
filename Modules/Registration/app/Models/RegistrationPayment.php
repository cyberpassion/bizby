<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationPayment extends TenantModel
{
	use HasFactory;
    protected $fillable = [
        'registration_id', 'amount', 'status', 'gateway_ref'
    ];
}
