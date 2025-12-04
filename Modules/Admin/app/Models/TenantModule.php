<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class TenantModule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /**
     * Attribute casting.
     */
    protected $casts = [
		'datetime'			=> 'datetime',
        'tenant_date' => 'date', // Laravel will cast it to Carbon
    ];

    /**
     * Default attribute values
     */
    protected $attributes = [];

	protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }

}
