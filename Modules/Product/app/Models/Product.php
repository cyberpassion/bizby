<?php

namespace Modules\Product\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends TenantModel
{
    use HasFactory;

    /**
     * Mass Assignable Fields (SAFE)
     */
    protected $fillable = [
        'product_type',
        'brand',
        'name',
        'sku',
        'retail_price',
        'sale_price',
        'unit',
        'availability',
        'product_description',
        'tags',
        'additional_features',
        'status'
    ];

    /**
     * Attribute Casting
     */
    protected $casts = [
        'retail_price' => 'decimal:2',
        'sale_price'   => 'decimal:2',
        'tags'         => 'array',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    /**
     * Default Values
     */
    protected $attributes = [
        'product_type' => 'physical',
        'status'       => 1
    ];

    /**
     * Appended Attributes
     */
    protected $appends = [
        'final_price'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function inventoryItems()
    {
        return $this->hasMany(
            \Modules\Inventory\Models\InventoryItem::class,
            'product_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->retail_price;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPhysical()
    {
        return $this->product_type === 'physical';
    }

    public function isService()
    {
        return $this->product_type === 'service';
    }
}