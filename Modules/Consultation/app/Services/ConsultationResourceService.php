<?php

namespace Modules\Consultation\Services;

class ConsultationResourceService
{
    public static function get($key)
    {
		$moduleLabel = 'Consultation';
		$moduleName = 'consultation';
        $data = [
            "{$moduleName}_menu-json" => [
				[
					'label'	=> $moduleLabel,
					'value'	=> $moduleName,
					'href'	=> "/{$moduleName}/home",
					'children'	=> [
		                ['label' => 'Add New', 'value' => 'add-new', 'href'=> "/{$moduleName}/create"],
						['label' => 'View List', 'value' => 'view-list', 'href'=> "/{$moduleName}s"],
						['label' => 'Settings', 'value' => 'settings', 'href'=> "/{$moduleName}/settings"],
						['label' => 'Reports', 'value' => 'reports', 'href'=> "/{$moduleName}/report"],
            		]
				]
			],
			"{$moduleName}_status-json" => [
                ['label' => 'Active', 'value' => 'active'],
                ['label' => 'Inactive', 'value' => 'inactive'],
            ],
        ];

        return $data[$key] ?? null;
    }
}
