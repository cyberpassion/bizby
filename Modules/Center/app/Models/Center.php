<?php

namespace Modules\Center\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'location',
        'contact',
        'capacity',
		'state',
		'place',
		'remark',
        'status',
    ];

	protected static function boot()
    {
        parent::boot();

        static::creating(function ($center) {

		    // Ensure tenant_id is set
		    if (!$center->tenant_id) {
        		$center->tenant_id = tenant('id'); // or auth tenant logic
    		}

		    $last = self::where('tenant_id', $center->tenant_id)
        		->orderBy('id', 'desc')
		        ->first();

		    $nextNumber = 1;

		    if ($last && $last->code) {
        		preg_match('/(\d+)$/', $last->code, $matches);
		        $nextNumber = isset($matches[1]) ? ((int)$matches[1] + 1) : 1;
    		}

		    $center->code = 'CTR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
		});
    }

    public function incidents()
    {
        return $this->hasMany(\Modules\Incident\Models\Incident::class);
    }
}