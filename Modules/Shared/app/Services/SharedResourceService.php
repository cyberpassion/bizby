<?php

namespace Modules\Shared\Services;

use Nwidart\Modules\Facades\Module;

class SharedResourceService
{
    public static function get($key)
    {
        $currentModule = 'shared'; // original module name if needed
        $data = [];
		$data["shared_menu-json"] = [
			[
				'label'	=> 'Dashboard',
				'value'	=> 'dashboard',
				'href'	=> '/dashboard',
			]
		];

        if ($key === 'module_menu-json') {
            $allModules = Module::all();
			$menuData = [];

            foreach ($allModules as $mod) { // avoid overwriting $module
                $moduleName = $mod->getName();
				$moduleNamelc = $mod->getLowerName();

                // Check if the module has a ResourceService
                $serviceClass = "Modules\\{$moduleName}\\Services\\{$moduleName}ResourceService";

                if (class_exists($serviceClass)) {
                    $moduleMenuData = $serviceClass::get("{$moduleNamelc}_menu-json");

                    if ($moduleMenuData) {
                        $menuData = array_merge($menuData, $moduleMenuData);
                    }
                }
            }
			$data[$key] = $menuData;
        }

        return $data[$key] ?? null;
    }
}
