<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Consultation\Support\Res;
use Modules\Consultation\Support\Actions;

$pg = 'consultation';

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
                    'permission' => Permission::create(Res::CONSULTATIONS),
                ],

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::CONSULTATIONS),
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
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'detail',
            ],

	        [
    	        'title'      => 'Update',
        	    'href'       => UrlPath::makeUpdate($pg, '{id}'),
            	'permission' => Permission::update(Res::CONSULTATIONS),
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
            	'permission' => Permission::delete(Res::CONSULTATIONS),
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
                'name'        => 'channel',
                'placeholder' => 'Modes',
                'col'         => 3,
                'dataKey'     => 'shared.communication-modes',
            ],

            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'consultation.statuses',
            ],
        ]

    ],

];
