<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingPageBlock extends Model
{
	use HasFactory;

	protected $connection = 'central';

    protected $fillable = [

        'listing_id',

        'type',

		'menu_title',
        'title',
        'subtitle',

        'content',

        'image',
        'image_2',

        'gallery',

        'video_url',

        'button_text',
        'button_link',

        'extra_data',

        'sort_order',

        'is_active',

        'background_color',
        'text_color',
    ];

    protected $casts = [

        'gallery' => 'array',
        'extra_data' => 'array',

        'is_active' => 'boolean',
    ];

    /* ---------------- Relations ---------------- */

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}