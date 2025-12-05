<?php

namespace Modules\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{

	use HasFactory;

	protected static function newFactory()
    {
        return \Modules\Lead\Database\Factories\LeadFactory::new();
    }

    protected $fillable = [
        'lead_code',
        'name',
        'contact_person',
        'mobile',
        'email',
        'district',
        'state',
        'pincode',
        'website',
        'category_id',
        'source_id',
        'stage_id',
        'is_existing_client',
        'place',
        'next_followup_date',
        'thread_parent_id',
    ];

    /**
     * Polymorphic creator
     */
    public function generatedBy(): MorphTo
    {
        return $this->morphTo('generated_by');
    }

    /**
     * Polymorphic assignee
     */
    public function assignedTo(): MorphTo
    {
        return $this->morphTo('assigned_to');
    }

    /**
     * Lead Followups
     */
    public function followups(): HasMany
    {
        return $this->hasMany(LeadFollowup::class, 'lead_id');
    }

    /**
     * Notes (optional)
     */
    public function notes(): MorphMany
    {
        return $this->morphMany('App\\Models\\Note', 'noteable');
    }
}
