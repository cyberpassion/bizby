<?php
$pg = 'consultation';

return [
	'menuItem-consultation' => [
		'admin'	=>	[
			'parent'		=>	[
				$pg	=>	'#',
			],
			'child'		=>	[
				$pg	=>	[
					['Add New'		=> "/{$pg}/create"],
	                ['View List'	=> "/{$pg}/list"],
    	            ['Report'		=> "/{$pg}/report"],
        	        ['Settings'		=> "/{$pg}/settings"],
				],
			],
		],
	],
    'sidebar-menu' => [
        [
            'label' => ucfirst($pg),
            'href' => "/{$pg}",
            'children' => [
                ['label' => 'Add New', 'href' => "/{$pg}/create"],
                ['label' => 'View List', 'href' => "/{$pg}/list"],
                ['label' => 'Report', 'href' => "/{$pg}/report"],
                ['label' => 'Settings', 'href' => "/{$pg}/settings"],
            ],
        ],
    ],
	'consultation_mode-json'	=>	['call'=>'Call'],
    'consultation_status-json' => [
        1 => 'Active',
        2 => 'Deleted',
    ],
];
