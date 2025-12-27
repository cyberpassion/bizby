<?php

namespace Modules\Note\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notes';

    protected $fillable = [
        'note_thread_id',
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'message',
        'message_type',
        'read_at',
        'meta',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'meta'    => 'array',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function thread()
    {
        return $this->belongsTo(NoteThread::class, 'note_thread_id');
    }

    public function sender()
    {
        return $this->morphTo(
            __FUNCTION__,
            'sender_type',
            'sender_id'
        );
    }

    public function receiver()
    {
        return $this->morphTo(
            __FUNCTION__,
            'receiver_type',
            'receiver_id'
        );
    }
}
