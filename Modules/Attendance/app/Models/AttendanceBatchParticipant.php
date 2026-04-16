<?php

namespace Modules\Attendance\Models;

use Modules\Admin\Models\Tenants\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceBatchParticipant extends TenantModel
{
    use HasFactory;

    protected $table = 'attendance_batch_participants';

    protected $fillable = [
        'tenant_id',
        'batch_id',
        'participant_id',
        'participant_type',
        'role'
    ];

    public function batch()
    {
        return $this->belongsTo(AttendanceBatch::class, 'batch_id');
    }

    public function participant()
    {
        return $this->morphTo();
    }
}