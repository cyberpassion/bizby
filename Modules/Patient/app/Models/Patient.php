<?php

namespace Modules\Patient\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Patient extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'age',
        'gender',
        'address',
    ];

    protected $casts = [];
    protected $attributes = [];
    protected $appends = [];

}