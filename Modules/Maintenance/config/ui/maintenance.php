<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Maintenance\Support\Res;
use Modules\Maintenance\Support\Actions;

$pg = 'maintenance';

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
                    'permission' => Permission::create(Res::MAINTENANCES),
                ],

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::MAINTENANCES),
                ],

                [
                    'title'      => 'Bulk-Ops',
                    'href'       => UrlPath::makeBulk($pg),
                    'permission' => Permission::bulk(Res::MAINTENANCES),
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
            	'permission' => Permission::update(Res::MAINTENANCES),
            	'action'     => 'update',
	        ],

			[
                'title'      => 'Upload',
                'href'       => UrlPath::makeUploads($pg, '{id}'),
                'permission' => Permission::create(Res::UPLOADS),
                'action'     => 'upload',
            ],

	        [
    	        'title'      => 'Delete',
        	    'href'       => UrlPath::makeDelete($pg, '{id}'),
            	'permission' => Permission::delete(Res::MAINTENANCES),
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
                'name'        => 'asset_id',
                'placeholder' => 'Asset',
                'col'         => 3,
                'dataKey'     => 'assets.list',
            ],
			[
                'type'        => 'select',
                'name'        => 'issue_type',
                'placeholder' => 'Issue Type',
                'col'         => 3,
                'dataKey'     => 'maintenance.issue-types',
            ],
			[
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'maintenance.statuses',
            ],
        ]

    ],

];
