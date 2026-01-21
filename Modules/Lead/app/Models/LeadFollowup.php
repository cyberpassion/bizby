<?php

namespace Modules\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadFollowup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lead_followups';

    protected $fillable = [
        'lead_id',
        'contact_by_id',
        'contact_by_type',
        'contact_date',
        'mode',
        'reference_no',
        'response',
        'remark',
        'next_followup_date',
        'tenant_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'contact_date' => 'datetime',
        'next_followup_date' => 'date',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function lead()
    {
        return $this->belongsTo(
            Lead::class,
            'lead_id'
        );
    }

    public function contactBy()
    {
        return $this->morphTo(
            __FUNCTION__,
            'contact_by_type',
            'contact_by_id'
        );
    }
}
