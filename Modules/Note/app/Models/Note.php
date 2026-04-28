<?php

namespace Modules\Note\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends TenantModel
{

	use HasFactory, SoftDeletes;

    protected $fillable = [
        'note_thread_id',
        'message',
        'message_type',
        'sender_id',
        'sender_type',
        'attachments',
        'read_at'
    ];

    protected $casts = [
        'attachments' => 'array',
        'read_at'     => 'datetime',
    ];

    public function thread()
{
    return $this->belongsTo(NoteThread::class);
}

public function sender()
{
    return $this->morphTo();
}
}