<?php
namespace Modules\Admin\Models\Addons;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
        'price',
        'billing_cycle',
        'is_active',
    ];
}
