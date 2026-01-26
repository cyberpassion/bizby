<?php

namespace Modules\Cashflow\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashflow extends TenantModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'cashflows';

    protected $fillable = [
        'direction',          // in | out
        'amount',
        'currency',
        'transaction_date',
        'category',
        'sub_category',
        'payment_mode',
        'reference_no',
        'party_id',
        'party_type',
        'related_to_id',
        'related_to_type',
        'description',
        'meta',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount'           => 'decimal:2',
        'meta'             => 'array',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function party()
    {
        return $this->morphTo();
    }

    public function relatedTo()
    {
        return $this->morphTo();
    }
}
