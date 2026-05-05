<?php

namespace Modules\Registration\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class RegistrationType extends TenantModel
{
	use HasFactory;

    protected $fillable = ['name', 'code', 'is_active','remark'];

	protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->code) && !empty($model->name)) {
                $model->code = Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->code = Str::slug($model->name);
            }
        });
    }

    public function steps()
    {
        return $this->hasMany(RegistrationTypeStep::class);
    }

    public function cycles()
    {
        return $this->hasMany(RegistrationCycle::class);
    }
}