<?php

namespace Modules\Registration\Models;

use \App\Models\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends TenantModel
{
	use HasFactory;
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