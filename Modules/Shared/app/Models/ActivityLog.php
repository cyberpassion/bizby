// Modules/Shared/Models/ActivityLog.php

<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $connection = 'central';

    protected $fillable = [

        'tenant_id',

        'causer_type',
        'causer_id',

        'subject_type',
        'subject_id',

        'event',

        'description',

        'old_values',
        'new_values',

        'ip_address',
        'user_agent',

        'method',
        'url',

        'meta',
    ];

    protected $casts = [

        'old_values' => 'array',

        'new_values' => 'array',

        'meta' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function causer()
    {
        return $this->morphTo();
    }

    public function subject()
    {
        return $this->morphTo();
    }

}