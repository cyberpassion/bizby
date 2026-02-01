<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationStep extends TenantModel
{
	use HasFactory;
    protected $fillable = [
        'registration_id', 'step', 'is_completed', 'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
