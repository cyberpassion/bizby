<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeHead extends Model
{
    protected $table = 'cyp_fee_head';

    protected $fillable = [
        'name',
        'frequency',
        'default_amount',
        'is_active',
    ];

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class, 'fee_head_id');
    }
}
