<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingPageBlock extends Model
{
    use HasFactory;

    protected $connection = 'central';

    protected $fillable = [
        'listing_id',

        'type',

        'menu_title',

        'slug',

        'title',

        'subtitle',

        'content',

        'image',

        'image_2',

        'gallery',

        'video_url',

        'button_text',

        'button_link',

        'background_color',

        'text_color',

        'layout',

        'alignment',

        'extra_data',

        'sort_order',

        'is_active',

        'seo_title',

        'seo_description',
    ];

    protected $casts = [
        'gallery' => 'array',

        'extra_data' => 'array',

        'is_active' => 'boolean',
    ];
}
