<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationTypeStep extends TenantModel
{
    protected $fillable = [
        'registration_type_id',
        'step_key',
        'title',
        'step_order',
        'is_required',
        'config'
    ];

    protected $casts = [
        'config' => 'array'
    ];
}