<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

	protected $connection = 'central';

    protected $fillable = [
        'business_name',
        'owner_name',
        'phone',
        'email',
        'website',
        'category_id',

        'address',
        'city',
        'district',
        'state',
        'pincode',
        'map_link',

        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'twitter',
        'other_links',

        'about',
        'services',
        'additional_info',

        'is_verified',
        'is_featured',
        'valid_till',

        'slug',
        'meta_title',
        'meta_description',

        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'valid_till'  => 'date:Y-m-d',
    ];

    /* ================= RELATIONS ================= */

    public function events()
    {
        return $this->hasMany(ListingEvent::class);
    }

    public function stats()
    {
        return $this->hasMany(ListingStat::class);
    }

    /* ================= SCOPES ================= */

    public function scopeVerified($q)
    {
        return $q->where('is_verified', 1);
    }

    public function scopeFeatured($q)
    {
        return $q->where('is_featured', 1);
    }
}