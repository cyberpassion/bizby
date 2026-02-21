<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicReport extends Model
{
    protected $table = 'public_reports';

    protected $fillable = [
        'tenant_id',
		'module',
		'name',
		'description',
        'token',
        'filters',      // ✅ KEY CHANGE
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
        'filters'    => 'array',       // ✅ Important
    ];

    /*
    |--------------------------------------------------------------------------
    | Auto Token Generation
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::creating(function ($publicReport) {

            if (empty($publicReport->token)) {
                $publicReport->token = Str::random(40);
            }

        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isExpired(): bool
    {
        return $this->expires_at && now()->gt($this->expires_at);
    }

    public function isAccessible(): bool
    {
        return $this->is_active && !$this->isExpired();
    }

    public function publicUrl(): string
    {
        return route('reports.public', $this->token);
    }

    public function regenerateToken(): void
    {
        $this->update([
            'token' => Str::random(40)
        ]);
    }
}