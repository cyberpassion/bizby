<?php

namespace Modules\Consultation\Services;

class ConsultationResourceService
{
    public static function get($key)
    {
		$module = 'consultation';
        $data = [
            "{$module}_menu-json" => [
                ['label' => 'Add New', 'value' => 'add-new', 'href'=> '/consultation/create']
            ],
			"{$module}_status-json" => [
                ['label' => 'Active', 'value' => 'active'],
                ['label' => 'Inactive', 'value' => 'inactive'],
            ],
        ];

        return $data[$key] ?? null;
    }
}
