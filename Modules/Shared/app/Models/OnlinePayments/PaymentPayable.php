<?php

namespace Modules\Shared\Models\OnlinePayments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class PaymentPayable extends Model
{
    use HasFactory;

    protected $fillable = [];

	protected $casts = [
        'meta' => 'array',
    ];

    protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }

	public function onlinePayment()
	{
    	return $this->belongsTo(
        	OnlinePayment::class,
        	'online_payment_id'
    	);
	}

	public function payable()
	{
    	return $this->morphTo();
	}

}
