<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Registration\Models\Traits\RegistrationPayable;

// Online Payments Specific
use Modules\Shared\Contracts\OnlinePayments\Payable;
use Modules\Shared\Contracts\OnlinePayments\FinalizePayment;

class Registration extends TenantModel implements Payable, FinalizePayment
{
	use HasFactory;
	use RegistrationPayable; // Payable implementation trait
    protected $fillable = [
        'user_id', 'type', 'status', 'submitted_at', 'meta'
    ];

    protected $casts = [
        'meta' => 'array',
        'submitted_at' => 'datetime',
    ];

    public function steps()
    {
        return $this->hasMany(RegistrationStep::class);
    }

    public function documents()
    {
        return $this->hasMany(RegistrationDocument::class);
    }

    public function payments()
    {
        return $this->hasMany(RegistrationPayment::class);
    }
}