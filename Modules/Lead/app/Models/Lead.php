<?php

namespace Modules\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leads';

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
        'generated_by_id',
        'generated_by_type',
        'assigned_to_id',
        'assigned_to_type',
        'category_id',
        'source_id',
        'stage_id',
        'is_existing_client',
        'place',
        'next_followup_date',
        'thread_parent_id',
    ];

    protected $casts = [
        'is_existing_client' => 'boolean',
        'next_followup_date' => 'date',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function followups()
    {
        return $this->hasMany(
            LeadFollowup::class,
            'lead_id'
        )->orderBy('contact_date', 'desc');
    }

    public function generatedBy()
    {
        return $this->morphTo(
            __FUNCTION__,
            'generated_by_type',
            'generated_by_id'
        );
    }

    public function assignedTo()
    {
        return $this->morphTo(
            __FUNCTION__,
            'assigned_to_type',
            'assigned_to_id'
        );
    }

    public function parent()
    {
        return $this->belongsTo(
            self::class,
            'thread_parent_id'
        );
    }

    public function children()
    {
        return $this->hasMany(
            self::class,
            'thread_parent_id'
        );
    }
}
