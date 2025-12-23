<?php

namespace Modules\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

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

    protected $fillable = [];

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

	public function leadfollowups()
	{
    	return $this->hasMany(LeadFollowup::class);
	}

	protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }

}
