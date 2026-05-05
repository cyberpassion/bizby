<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Registration\Support\Res;
use Modules\Registration\Support\Actions;

use Modules\Shared\Support\KeyName;

$pg = 'registration';

return [

	'sidebar-menu.portal' => [

		'items' => [

            [
                'title'      => 'Home',
                'href'       => UrlPath::makeHome($pg),
                'permission' => Permission::view(Res::HOME),
            ],
			[
                'title'      => 'My Applications',
                'href'       => UrlPath::make($pg, 'my'),
                'permission' => Permission::view(Res::HOME),
            ],
			[
                'title'      => 'Available Applications',
                'href'       => UrlPath::make($pg, 'list'),
                'permission' => Permission::view(Res::HOME),
            ]

		]

	],

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
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
                'title' => 'Types',
                'description' => 'Manage Types',
                'items' => [
                    /*
		            |--------------------------------------------------------------------------
        		    | CREATE REGISTRATION TYPE (NOT USER REGISTRATION)
            		|--------------------------------------------------------------------------
		            */
        		    [
                		'title'      => '+ New',
		                'href'       => UrlPath::make($pg, 'create-type'),
        		        'permission' => Permission::create(Res::TYPES),
            		],

		            /*
        		    |--------------------------------------------------------------------------
		            | LIST REGISTRATION TYPES
        		    |--------------------------------------------------------------------------
            		*/
    		        [
	        	        'title'      => 'View List',
                		'href'       => UrlPath::make($pg, 'types'),
		                'permission' => Permission::list(Res::TYPES),
        		    ],
                ],
            ],

			[
                'title' => 'Cycles',
                'description' => 'Manage Cycles',
                'items' => [
                    /*
		            |--------------------------------------------------------------------------
        		    | CREATE REGISTRATION CYCLE (NOT USER REGISTRATION)
            		|--------------------------------------------------------------------------
		            */
        		    [
                		'title'      => '+ New',
		                'href'       => UrlPath::make($pg, 'create-cycle'),
        		        'permission' => Permission::create(Res::CYCLES),
            		],

		            /*
		            |--------------------------------------------------------------------------
        		    | LIST REGISTRATION CYCLES
		            |--------------------------------------------------------------------------
        		    */
            		[
		                'title'      => 'View List',
        		        'href'       => UrlPath::make($pg, 'cycles'),
                		'permission' => Permission::list(Res::CYCLES),
		            ],
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | USER REGISTRATIONS (ACTUAL DATA)
            |--------------------------------------------------------------------------
            */
            [
                'title'      => 'Registrations',
                'href'       => UrlPath::makeList($pg),
                'permission' => Permission::list(Res::REGISTRATIONS),
            ],

            [
                'title'      => 'Reports',
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
    | Row Actions (CRITICAL for Workflow Modules)
    |--------------------------------------------------------------------------
    */
    'single-actions' => [

		KeyName::make(Res::TYPES)	=> [
			[
                'title'      => 'Add/Update Steps',
                'href'       => UrlPath::make($pg, '{id}/steps'),
                'permission' => Permission::view(Res::STEPS),
                'action'     => 'redirect',
            ],

            [
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::REGISTRATIONS),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::REGISTRATIONS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
		],

		KeyName::make(Res::CYCLES)	=> [
            [
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::CYCLES),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::CYCLES),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
		],

		KeyName::make(Res::REGISTRATIONS)	=> [
			[
                'title'      => 'View',
                'href'       => UrlPath::makeView($pg, '{id}'),
                'permission' => Permission::view(Res::REGISTRATIONS),
                'action'     => 'detail',
            ]
		],

    ],

    /*
    |--------------------------------------------------------------------------
    | Filters (List Screen)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        KeyName::make(Res::TYPES) => [
            [
                'type'        => 'select',
                'name'        => 'registration_status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'registration.statuses',
            ]
        ],

		KeyName::make(Res::CYCLES) => [
            [
                'type'        => 'select',
                'name'        => 'registration_status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'registration.statuses',
            ]
        ],

		KeyName::make(Res::REGISTRATIONS) => [
            [
                'type'        => 'select',
                'name'        => 'registration_status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'registration.statuses',
            ]
        ],

    ],

];
