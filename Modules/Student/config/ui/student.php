<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Student\Support\Res;
use Modules\Student\Support\Actions;

$pg = 'student';

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
                    'title' => 'Students',
                    'items' => [
                        [
                            'title'      => 'Add New',
                            'href'       => UrlPath::makeCreate($pg),
                            'permission' => Permission::create(Res::STUDENTS),
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => UrlPath::makeList($pg),
                            'permission' => Permission::list(Res::STUDENTS),
                        ],
                        [
                            'title'      => 'Transfer',
                            'href'       => UrlPath::make($pg, 'transition'),
                            'permission' => Permission::update(Res::STUDENTS),
                        ],
                        [
                            'title'      => 'Bulk-Ops',
                            'href'       => UrlPath::makeBulk($pg),
                            'permission' => Permission::bulk(Res::STUDENTS),
                        ],
                    ],
                ],

                [
                    'title' => 'Academic Setup',
                    'items' => [
                        [
                            'title'      => 'Academic Years',
                            'href'       => UrlPath::make($pg, 'academic-years'),
                            'permission' => Permission::view(Res::ACADEMIC),
                        ],
                        [
                            'title'      => 'Classes',
                            'href'       => UrlPath::make('shared', 'terms/student/classes'),
                            'permission' => Permission::view(Res::ACADEMIC),
                        ],
                        [
                            'title'      => 'Sections',
                            'href'       => UrlPath::make('shared', 'terms/student/sections'),
                            'permission' => Permission::view(Res::ACADEMIC),
                        ],
                    ],
                ],

                [
                    'title' => 'Fee Management',
                    'items' => [
                        [
                            'title'      => 'Fee Heads',
                            'href'       => UrlPath::make('shared', 'terms/student/fee-heads'),
                            'permission' => Permission::view(Res::FEES),
                        ],
						[
				            'title'      => 'Fee Patterns',
				            'href'       => UrlPath::make($pg, 'fee-structure-patterns'),
			            	'permission' => Permission::update(Res::FEES),
        				],
                        [
                            'title'      => 'Fee Structure',
                            'href'       => UrlPath::make($pg, 'fee-structure'),
                            'permission' => Permission::update(Res::FEES),
                        ],
						[
                            'title'      => 'Fee Discounts',
                            'href'       => UrlPath::make($pg, 'fee-discounts'),
                            'permission' => Permission::update(Res::FEES),
                        ],
						[
                            'title'      => 'Fee Overrides',
                            'href'       => UrlPath::make($pg, 'fee-structure-overrides'),
                            'permission' => Permission::update(Res::FEES),
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Student Report',
                            'href'       => UrlPath::make($pg, 'report-students'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
                        [
                            'title'      => 'Fee Collection',
                            'href'       => UrlPath::make($pg, 'report-fees'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
                        [
                            'title'      => 'Fee Due',
                            'href'       => UrlPath::make($pg, 'report-dues'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
						[
                            'title'      => 'Fee Discount',
                            'href'       => UrlPath::make($pg, 'report-fee-discounts'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
						[
                            'title'      => 'Fee Defaulter',
                            'href'       => UrlPath::make($pg, 'report-fee-defaulters'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => UrlPath::makeSettings($pg),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Admission Rules',
                            'href'       => UrlPath::make($pg, 'admission-rules'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Fee Rules',
                            'href'       => UrlPath::make($pg, 'fee-rules'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Other Settings',
                            'href'       => UrlPath::make($pg, 'other-section'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'Integrations',
                            'href'       => UrlPath::makePlugins($pg),
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

        KeyName::make(Res::STUDENTS) => [
			Actions::LIST => [
	            [
    	            'title'      => 'View Documents',
        	        'href'       => UrlPath::makeDocuments($pg, '{id}'),
            	    'permission' => Permission::view(Res::DOCUMENTS),
                	'action'     => 'document',
	            ],

	            [
    	            'title'      => 'Edit',
        	        'href'       => UrlPath::makeUpdate($pg, '{id}'),
            	    'permission' => Permission::update(Res::STUDENTS),
                	'action'     => 'update',
	            ],

				[
					'title'      => 'Fee',
        	        'href'       => '#',
            	    'permission' => Permission::update(Res::STUDENTS),
                	'action'     => 'update',
					'items'		=>	[
						[
		                	'title'      => 'Submit Fee',
	        		        'href'       => UrlPath::make($pg, '/fee-submission/{id}'),
    	            		'permission' => Permission::update(Res::STUDENTS),
    			            'action'     => 'update',
	        		    ],
						[
		            	    'title'      => 'Fee History',
        		        	'href'       => UrlPath::make($pg, '/fee-history/{id}'),
	                		'permission' => Permission::update(Res::STUDENTS),
    			            'action'     => 'update',
	    	    	    ],
						[
		        	        'title'      => 'Add Fee Discount',
        		    	    'href'       => UrlPath::make($pg, '/fee-discount/{id}'),
                			'permission' => Permission::update(Res::STUDENTS),
    		            	'action'     => 'update',
		        	    ],
						[
			                'title'      => 'Custom Fee Structure',
        			        'href'       => UrlPath::make($pg, '/fee-structure/set?student_id={id}'),
                			'permission' => Permission::update(Res::STUDENTS),
    		        	    'action'     => 'update',
	        	    	],
					]
				],

	            [
     	           'title'      => 'Upload',
        	        'href'       => UrlPath::makeUploads($pg, '{id}'),
            	    'permission' => Permission::create(Res::UPLOADS),
                	'action'     => 'upload',
            	],

	            [
    	            'title'      => 'View Profile',
        	        'href'       => UrlPath::makeProfile($pg, '{id}'),
            	    'permission' => Permission::view(Res::STUDENTS),
                	'action'     => 'view',
	            ],

	            [
    	            'title'      => 'Delete',
        	        'href'       => UrlPath::makeDelete($pg, '{id}'),
            	    'permission' => Permission::delete(Res::STUDENTS),
                	'action'     => 'delete',
	                'method'     => 'DELETE',
    	            'variant'    => 'danger',
        	    ],
        	]
		],
		KeyName::make(Res::FEE_STRUCTURE_PATTERNS) => [
		    Actions::LIST => [
				[
    	            'title'      => 'Edit',
        	        'href'       => UrlPath::make($pg, 'fee-structure-pattern?id={id}'),
            	    'permission' => Permission::update(Res::STUDENTS),
                	'action'     => 'update',
	            ],
			]
		],
		KeyName::make(Res::ACADEMIC_YEARS) => [],
		KeyName::make(Res::FEE_DISCOUNTS) => [
			Actions::LIST => [
	            [
    	            'title'      => 'View',
        	        'href'       => UrlPath::makeDocuments($pg, '{id}'),
            	    'permission' => Permission::view(Res::DOCUMENTS),
                	'action'     => 'document',
	            ],
				[
    	            'title'      => 'Edit',
        	        'href'       => UrlPath::makeUpdate($pg, '{id}'),
            	    'permission' => Permission::update(Res::STUDENTS),
                	'action'     => 'update',
	            ],
			]
		],
		KeyName::make(Res::FEE_OVERRIDES) => [
			Actions::LIST => [
	            [
    	            'title'      => 'View',
        	        'href'       => UrlPath::makeDocuments($pg, '{id}'),
            	    'permission' => Permission::view(Res::DOCUMENTS),
                	'action'     => 'document',
	            ],
				[
    	            'title'      => 'Edit',
        	        'href'       => UrlPath::makeUpdate($pg, '{id}'),
            	    'permission' => Permission::update(Res::STUDENTS),
                	'action'     => 'update',
	            ],
			]
		]

    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        KeyName::make(Res::STUDENTS) => [
            [
                'type'        => 'select',
                'name'        => 'year_id',
                'placeholder' => 'Session',
                'col'         => 3,
                'dataKey'     => 'student.academic-years',
            ],
            [
                'type'        => 'select',
                'name'        => 'class_term_id',
                'placeholder' => 'Class',
                'col'         => 3,
                'dataKey'     => 'student.classes',
            ],
            [
                'type'        => 'select',
                'name'        => 'section_term_id',
                'placeholder' => 'Section',
                'col'         => 3,
                'dataKey'     => 'student.sections',
            ],
            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'student.statuses',
            ],
        ]

    ],
];
