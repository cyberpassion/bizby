<?php

return [

	[
		'key' => 'student',

		'label' => 'Student',

		'icon' => 'graduation-cap',

		'items' => [

			[
				'key' => 'classes',
				'label' => 'Classes',
				'permission' => 'student.classes.view',
			],

			[
				'key' => 'sections',
				'label' => 'Sections',
				'permission' => 'student.sections.view',
			],

			[
				'key' => 'houses',
				'label' => 'Houses',
				'permission' => 'student.houses.view',
			],

			[
				'key' => 'categories',
				'label' => 'Categories',
				'permission' => 'student.categories.view',
			],

			[
				'key' => 'fee-heads',
				'label' => 'Fee Heads',
				'permission' => 'student.categories.view',
			],

		],
	],

	[
		'key' => 'employee',

		'label' => 'Employee',

		'icon' => 'briefcase',

		'items' => [

			[
				'key' => 'departments',
				'label' => 'Departments',
				'permission' => 'employee.departments.view',
			],

			[
				'key' => 'designations',
				'label' => 'Designations',
				'permission' => 'employee.designations.view',
			],

		],
	],

];