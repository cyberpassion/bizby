<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingStat extends Model
{
    use HasFactory;

	protected $connection = 'central';

    protected $fillable = [
        'listing_id',
        'views',
        'unique_views',
        'contacts_clicked',
        'website_clicked',
        'whatsapp_clicked',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}