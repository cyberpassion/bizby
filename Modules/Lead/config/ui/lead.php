<?php
use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Lead\Support\Res;
use Modules\Lead\Support\Actions;

$pg = 'lead';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title'      => 'Dashboard',
                    'href'       => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title'      => 'Add New',
                    'href'       => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::LEADS),
                ],

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::LEADS),
                ],

                [
                    'title'      => 'Bulk-Ops',
                    'href'       => UrlPath::makeBulk($pg),
                    'permission' => Permission::bulk(Res::LEADS),
                ],

                [
                    'title'      => 'Report',
                    'href'       => UrlPath::makeReport($pg),
                    'permission' => Permission::report(Res::REPORTS),
                ],

                [
                    'title'      => 'Settings',
                    'href'       => UrlPath::makeSettings($pg),
                    'permission' => Permission::update(Res::SETTINGS),
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'View Calendar',
                            'href'       => UrlPath::make($pg, 'plugin/calendar'),
                            'permission' => Permission::view(Res::PLUGINS),
                        ],
                    ],
                ],
            ],
        ],
    ],

	/*
    |--------------------------------------------------------------------------
    | Row Actions
    |--------------------------------------------------------------------------
    */
    'single-actions' => [

	    Actions::LIST	=>	[
			[
	    	    'title'      => 'Add Followup',
    	    	'href'       => UrlPath::make($pg, 'new-followup'),
	    	    'permission' => Permission::create(Res::FOLLOWUPS),
    	    	'action'     => 'sheet',
				'params'	 => [
					'id'	 => ':id'
				]
		    ],

		    [
    		    'title'      => 'Edit',
        		'href'       => UrlPath::makeUpdate($pg, '{id}'),
	        	'permission' => Permission::update(Res::LEADS),
    	    	'action'     => 'update',
		    ],

		    [
    		    'title'      => 'Delete',
        		'href'       => UrlPath::makeDelete($pg, '{id}'),
	        	'permission' => Permission::delete(Res::LEADS),
    	    	'action'     => 'delete',
	        	'method'     => 'DELETE',
    	    	'variant'    => 'danger',
    		],
		]

	],

	/*
	|--------------------------------------------------------------------------
	| List Filters (FULL CONFIG – used by frontend)
	|--------------------------------------------------------------------------
	*/
	'filters' => [

    	Actions::LIST	=>	[
			[
    		    'type'        => 'select',
        		'name'        => 'assigned_to_id',
	        	'placeholder' => 'Assigned To',
    	    	'col'         => 3,
        		'dataKey'     => 'employees.list',
	    	],
			[
		        'type'        => 'select',
    		    'name'        => 'stage_id',
        		'placeholder' => 'Stage',
	        	'col'         => 3,
    	    	'dataKey'     => 'lead.lead-stages',
		    ],
    		[
	    	    'type'        => 'select',
    	    	'name'        => 'category_id',
	        	'placeholder' => 'Category',
		        'col'         => 3,
    		    'dataKey'     => 'lead.categories',
		    ],
    		[
	    	    'type'        => 'select',
    	    	'name'        => 'source_id',
	        	'placeholder' => 'Source',
		        'col'         => 3,
    		    'dataKey'     => 'lead.lead-sources',
    		]
		]
	],

];
