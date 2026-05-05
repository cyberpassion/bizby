<?php

namespace Modules\Registration\Models;

use App\Models\User;
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

	protected $with = ['steps','documents','payments','user'];
	protected $appends = ['cycle_name','user_name','user_email'];

    protected $fillable = [
        'user_id',
        'registration_cycle_id',
        'registration_status',
        'submitted_at',
    ];

	protected $casts = [
        'meta' => 'array',
        'submitted_at' => 'datetime',
    ];

    public function cycle()
    {
        return $this->belongsTo(RegistrationCycle::class, 'registration_cycle_id');
    }

	public function getCycleNameAttribute()
	{
    	return $this->cycle?->name;
	}

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

	public function getUserNameAttribute()
	{
    	return $this->user?->name;
	}
	public function getUserEmailAttribute()
	{
    	return $this->user?->email;
	}

    public function type()
    {
        return $this->hasOneThrough(
            RegistrationType::class,
            RegistrationCycle::class,
            'id',
            'id',
            'registration_cycle_id',
            'registration_type_id'
        );
    }

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