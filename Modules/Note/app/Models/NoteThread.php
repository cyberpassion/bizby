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

    public function notes()
    {
        return $this->hasMany(Note::class, 'note_thread_id');
    }

    public function participants()
    {
        return $this->hasMany(NoteThreadParticipant::class, 'note_thread_id');
    }

    public function assignedTo()
    {
        return $this->morphTo();
    }
}