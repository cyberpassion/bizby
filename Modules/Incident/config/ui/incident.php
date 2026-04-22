<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Incident\Support\Res;
use Modules\Incident\Support\Actions;

$pg = 'incident';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title'      => 'Home',
                    'href'       => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title'      => 'Add New',
                    'href'       => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::INCIDENTS),
                ],

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::INCIDENTS),
                ],

                [
                    'title'      => 'Report',
                    'href'       => UrlPath::makeReport($pg),
                    'permission' => Permission::view(Res::REPORTS),
                ],

                [
                    'title'      => 'Settings',
                    'href'       => UrlPath::makeSettings($pg),
                    'permission' => Permission::update(Res::SETTINGS),
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

		Actions::LIST => [
			[
                'title'      => 'View Slip',
                'href'       => UrlPath::makeDocuments($pg, '{id}'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'document',
            ],

			[
                'title'      => 'View Details',
                'href'       => UrlPath::makeDetail($pg, '{id}'),
                'permission' => Permission::view(Res::DETAILS),
                'action'     => 'detail',
            ],

	        [
    	        'title'      => 'Update',
        	    'href'       => UrlPath::makeUpdate($pg, '{id}'),
            	'permission' => Permission::update(Res::INCIDENTS),
            	'action'     => 'update',
	        ],

			[
                'title'      => 'Upload',
                'href'       => UrlPath::makeUploads($pg, '{id}'),
                'permission' => Permission::create(Res::DOCUMENTS),
                'action'     => 'upload',
            ],

	        [
    	        'title'      => 'Delete',
        	    'href'       => UrlPath::makeDelete($pg, '{id}'),
            	'permission' => Permission::delete(Res::INCIDENTS),
	            'action'     => 'delete',
    	        'method'     => 'DELETE',
        	    'variant'    => 'danger',
        	]
		]

    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST	=>	[
            [
                'type'        => 'select',
                'name'        => 'type',
                'placeholder' => 'Types',
                'col'         => 3,
                'dataKey'     => 'incident.types',
            ],

			[
                'type'        => 'select',
                'name'        => 'severity',
                'placeholder' => 'Severity',
                'col'         => 3,
                'dataKey'     => 'incident.severities',
            ],

            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'incident.statuses',
            ],
        ]

    ],

];
