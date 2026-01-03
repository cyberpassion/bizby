<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuthToken extends Model
{
    protected $fillable = [
        'type',
        'token',
        'expires_at',
        'used_at',
        'attempts',
        'meta',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at'    => 'datetime',
        'meta'       => 'array',
    ];

    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }

    /* -----------------------------
     | Scopes
     |-----------------------------*/
    public function scopeValid($query)
    {
        return $query
            ->whereNull('used_at')
            ->where('expires_at', '>', now());
    }
}
