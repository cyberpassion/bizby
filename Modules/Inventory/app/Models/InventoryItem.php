<?php

namespace Modules\Inventory\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends TenantModel
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'product_id',
        'name',
        'code',
        'unit',
        'minimum_threshold',
        'maximum_threshold',
        'current_stock',
        'center_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'minimum_threshold' => 'float',
        'maximum_threshold' => 'float',
        'current_stock' => 'float',
    ];

    /* ======================================================
     | AUTO GENERATE CODE
     ====================================================== */
    protected static function boot()
	{
    	parent::boot();

	    static::creating(function ($item) {

    	    // Generate code if not provided
        	if (!$item->code || trim($item->code) === '') {

	            $last = self::orderBy('id', 'desc')->first();

    	        $next = 1;

        	    if ($last && $last->code) {
            	    preg_match('/(\d+)$/', $last->code, $matches);
                	$next = isset($matches[1]) ? ((int)$matches[1] + 1) : 1;
	            }

    	        $item->code = 'INV-' . str_pad($next, 4, '0', STR_PAD_LEFT);
        	}
    	});
	}

    // Relationships
    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'inventory_item_id');
    }

	public function product()
	{
    	return $this->belongsTo(\Modules\Product\Models\Product::class, 'product_id');
	}

}