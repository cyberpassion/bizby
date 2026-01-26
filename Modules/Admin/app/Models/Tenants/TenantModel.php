<?php

namespace Modules\Admin\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class TenantModel extends Model
{
    protected static function booted()
    {
        // Only apply in tenant context
        if (! tenant()) {
            return;
        }

        // Enforce tenant isolation on all queries
        static::addGlobalScope('tenant', function (Builder $builder) {
            $builder->where(
                $builder->getModel()->getTable() . '.tenant_id',
                tenant()->id
            );
        });

        // Auto-fill tenant_id on create
        static::creating(function ($model) {
            $model->tenant_id ??= tenant()->id;
        });
    }
}
