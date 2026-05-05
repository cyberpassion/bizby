<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationDocument extends TenantModel
{
	use HasFactory;
    protected $fillable = [
        'registration_id', 'name', 'path', 'upload_id', 'verified_at'
    ];

	public function uploads()
    {
        return $this->belongsTo(\Modules\Shared\Models\Upload::class,'upload_id');
    }

}
