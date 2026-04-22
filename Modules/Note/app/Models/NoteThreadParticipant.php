<?php

namespace Modules\Note\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteThreadParticipant extends TenantModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'note_thread_id',
        'participant_id',
        'participant_type',
        'last_read_at',
        'is_admin',
    ];

    protected $casts = [
        'last_read_at' => 'datetime',
        'is_admin'     => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Thread this participant belongs to
     */
    public function thread()
    {
        return $this->belongsTo(NoteThread::class, 'note_thread_id');
    }

    /**
     * Polymorphic participant (User, Admin, etc.)
     */
    public function participant()
    {
        return $this->morphTo();
    }
}