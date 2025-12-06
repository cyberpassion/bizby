<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'group',
        'module',
        'sort_order',
        'status',
    ];

    // Boot method to attach model events
    protected static function boot()
    {
        parent::boot();

        // Before saving, ensure slug is set
        static::saving(function ($term) {
            if (empty($term->slug) && !empty($term->name)) {
                $term->slug = Str::slug($term->name);
            }
        });
    }
}
