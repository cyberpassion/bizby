<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationCycle extends TenantModel
{
    protected $fillable = [
        'registration_type_id',
        'name',
        'start_date',
        'end_date',
		'remark',
        'status'
    ];

	protected $casts = [
        'start_date'			 => 'date:Y-m-d',
		'end_date'			 => 'date:Y-m-d'
    ];

    public function type()
    {
        return $this->belongsTo(RegistrationType::class, 'registration_type_id');
    }

	public function registrations()
	{
    	return $this->hasMany(\Modules\Registration\Models\Registration::class, 'registration_cycle_id');
	}

}