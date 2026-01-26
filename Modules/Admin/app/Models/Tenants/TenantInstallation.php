<?php
namespace Modules\Admin\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Admin\Enums\Tenants\InstallationStatus;
use Modules\Admin\Enums\Tenants\OperationType;
use Modules\Admin\Enums\Tenants\TargetType;

use Illuminate\Support\Str;

class TenantInstallation extends Model
{
	use HasFactory;

    protected $connection = 'central';

    protected $fillable = [
        'uuid','tenant_id',
        'target_type','target_id','target_key',
        'operation','status','step','progress',
        'attempts','last_error','logs','config',
        'started_at','finished_at'
    ];

    protected $casts = [
        'logs' => 'array',
        'config' => 'array',
        'status' => InstallationStatus::class,
        'operation' => OperationType::class,
        'target_type' => TargetType::class,
    ];

	protected static function booted()
	{
    	static::creating(function ($model) {
	        $model->uuid ??= Str::uuid()->toString();
    	});
	}

}
