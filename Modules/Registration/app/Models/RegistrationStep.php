<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationStep extends TenantModel
{
	use HasFactory;
   protected $fillable = [
        'registration_id',
        'registration_type_step_id',
        'status',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

	public function typeStep()
    {
        return $this->belongsTo(RegistrationTypeStep::class, 'registration_type_step_id');
    }

}
