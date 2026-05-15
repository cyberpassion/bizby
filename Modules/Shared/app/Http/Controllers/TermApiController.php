<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\Term;
use Modules\Shared\Http\Controllers\SharedApiController;

class TermApiController extends SharedApiController
{
	protected $searchable = ['group'];

    protected function model()
    {
        return Term::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [];
	}

	public function navigation()
	{
    	$groups = require module_path(
	        'Shared',
    	    'config/data/resource_groups.php'
    	);

	    $modules = collect($groups)

	        ->map(function ($group) {

	            return [

	                'id' => $group['key'] ?? null,

    	            'name' => $group['label'] ?? null,

        	        'icon' => $group['icon'] ?? null,

            	    'groups' => collect($group['items'] ?? [])

                	    ->map(function ($item) {

                    	    return [

                        	    'id' => $item['key'] ?? null,

                            	'name' => $item['label'] ?? null,

	                            'permission' => $item['permission'] ?? null,
    	                    ];
        	            })

	                    ->values(),
    	        ];
        	})

	        ->values();

	    return response()->json([

    	    'status' => 'success',

        	'data' => [
            	'modules' => $modules,
        	],
    	]);
	}

}
