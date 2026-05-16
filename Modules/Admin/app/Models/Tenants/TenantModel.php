<?php

namespace Modules\Admin\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\Shared\Services\ActivityLogService;

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
            /*$builder->where(
                $builder->getModel()->getTable() . '.tenant_id',
                tenant()->id
            );*/
        });

        // Auto-fill tenant_id on create
        static::creating(function ($model) {
            $model->tenant_id ??= tenant()->id;
        });

		/*
	    |--------------------------------------------------------------------------
    	| CREATED
    	|--------------------------------------------------------------------------
    	*/

	    static::created(function ($model) {

			if (static::shouldSkipActivityLog($model)) {
		        return;
    		}

	        ActivityLogService::log(

	            'created',

	            $model,

	            'Record created',

	            [],

	            $model->toArray()
    	    );
    	});

	    /*
    	|--------------------------------------------------------------------------
	    | UPDATED
    	|--------------------------------------------------------------------------
    	*/

	    static::updated(function ($model) {

		    if (static::shouldSkipActivityLog($model)) {
        		return;
    		}

		    /*
		    |--------------------------------------------------------------------------
		    | IGNORE SYSTEM-ONLY CHANGES
		    |--------------------------------------------------------------------------
    		*/

		    $changes = collect($model->getChanges())
		        ->except([
        		    'updated_at',
			        'deleted_at',
			        'deleted_by',
		        ])
        		->toArray();

		    // nothing meaningful changed
		    if (empty($changes)) {
        		return;
    		}

		    /*
		    |--------------------------------------------------------------------------
		    | LOG ACTIVITY
		    |--------------------------------------------------------------------------
    		*/

		    ActivityLogService::log(

		        'updated',

		        $model,

		        'Record updated',

		        $model->getOriginal(),

		        $changes
    		);
		});

    }

	// Prevent Activity Loggin Itself causing recursion
	protected static function shouldSkipActivityLog($model): bool
	{
    	return $model instanceof
        	\Modules\Shared\Models\ActivityLog;
	}

	public function delete()
	{
    	$old = $this->getOriginal();

	    $this->status = 2;

	    $this->deleted_by = auth()->id();

	    $this->deleted_at = now();

	    $saved = $this->save();

	    /*
    	|--------------------------------------------------------------------------
	    | MANUAL DELETE LOG
    	|--------------------------------------------------------------------------
    	*/

	    if (
    	    $saved &&
        	!static::shouldSkipActivityLog($this)
	    ) {

	        ActivityLogService::log(

    	        'deleted',

	            $this,

	            'Record deleted',

	            $old,

	            [
    	            'status' => 2
        	    ]
        	);
    	}

	    return $saved;
	}

}
