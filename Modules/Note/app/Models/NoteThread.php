<?php

namespace Modules\Note\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteThread extends TenantModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'note_threads';

    protected $fillable = [
        'type',
        'subject',
        'participant_one_id',
        'participant_one_type',
        'participant_two_id',
        'participant_two_type',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function messages()
    {
        return $this->hasMany(Note::class, 'note_thread_id')
                    ->orderBy('created_at');
    }

    public function participantOne()
    {
        return $this->morphTo(
            __FUNCTION__,
            'participant_one_type',
            'participant_one_id'
        );
    }

    public function participantTwo()
    {
        return $this->morphTo(
            __FUNCTION__,
            'participant_two_type',
            'participant_two_id'
        );
    }
}
