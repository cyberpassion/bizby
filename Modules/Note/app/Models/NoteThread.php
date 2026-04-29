<?php

namespace Modules\Note\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteThread extends TenantModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'subject',
        'status',
        'priority',
        'is_internal',
        'last_message',
        'last_message_at',
        'unread_count',
        'assigned_to_id',
        'assigned_to_type'
    ];

    protected $casts = [
        'is_internal'     => 'boolean',
        'last_message_at' => 'datetime',
    ];

    public function context()
{
    return $this->morphTo();
}

public function notes()
{
    return $this->hasMany(Note::class);
}

public function participants()
{
    return $this->hasMany(NoteThreadParticipant::class);
}

public function assignee()
{
    return $this->hasOne(NoteThreadParticipant::class)
        ->where('role', 'assignee')
        ->with('participant');
}

public function watchers()
{
    return $this->hasMany(NoteThreadParticipant::class)
        ->where('role', 'watcher')
        ->with('participant');
}

public function initiator()
{
    return $this->hasOne(NoteThreadParticipant::class)
        ->where('role', 'initiator')
        ->with('participant');
}

	/*
    |--------------------------------------------------------------------------
    | Scopes (ADD THESE 👇)
    |--------------------------------------------------------------------------
    */

    public function scopeAssignedToMe($query)
    {
        return $query->whereHas('participants', function ($q) {
            $q->where('role', 'assignee')
              ->where('participant_id', auth()->id())
              ->where('participant_type', auth()->user()->getMorphClass());
        });
    }

    public function scopeInvolvingMe($query)
    {
        return $query->whereHas('participants', function ($q) {
            $q->where('participant_id', auth()->id())
              ->where('participant_type', auth()->user()->getMorphClass());
        });
    }

}