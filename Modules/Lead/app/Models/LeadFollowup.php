<?php

namespace Modules\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LeadFollowup extends Model
{

	use HasFactory;

	protected static function newFactory()
    {
        return \Modules\Lead\Database\Factories\LeadFollowupFactory::new();
    }

    protected $fillable = [
        'lead_id',
        'contact_date',
        'mode',
        'reference_no',
        'response',
        'remark',
        'next_followup_date',
    ];

    /**
     * Parent Lead
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    /**
     * Polymorphic - Who contacted the lead
     */
    public function contactBy(): MorphTo
    {
        return $this->morphTo('contact_by');
    }
}
