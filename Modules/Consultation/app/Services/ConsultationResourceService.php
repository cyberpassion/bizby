<?php

namespace Modules\Consultation\Services;

class ConsultationResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Consultation';
        $moduleName = 'consultation';
        $res = null;

        switch ($key) {
            case "{$moduleName}_menu-json":
                $res = [
                    [
                        'label' => $moduleLabel,
                        'value' => $moduleName,
                        'href' => "/{$moduleName}/home",
                        'children' => [
                            ['label' => 'Add New', 'value' => 'add-new', 'href' => "/{$moduleName}/create"],
                            ['label' => 'View List', 'value' => 'view-list', 'href' => "/{$moduleName}s"],
                            ['label' => 'Reports', 'value' => 'reports', 'href' => "/{$moduleName}/report"],
                            ['label' => 'Settings', 'value' => 'settings', 'href' => "/{$moduleName}/settings"],
                        ]
                    ]
                ];
                break;

            case "{$moduleName}_status-json":
                $res = [
                    ['label' => 'Active', 'value' => 'active'],
                    ['label' => 'Inactive', 'value' => 'inactive'],
                ];
                break;

            default:
                $res = null;
                break;
        }

        return $res;
    }
}
