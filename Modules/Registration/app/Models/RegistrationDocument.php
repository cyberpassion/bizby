<?php

namespace Modules\Registration\Models;

use \App\Models\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationDocument extends TenantModel
{
	use HasFactory;
    protected $fillable = [
        'registration_id', 'name', 'path', 'verified_at'
    ];
}
