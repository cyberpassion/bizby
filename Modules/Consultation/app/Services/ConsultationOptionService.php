<?php

namespace Modules\Consultation\Services;

class ConsultationOptionService
{
    public static function get($key)
    {
        $data = [
            'gender-json' => [
                ['label' => 'Male', 'value' => 'male'],
                ['label' => 'Female', 'value' => 'female'],
                ['label' => 'Other', 'value' => 'other'],
            ],
            'status-json' => [
                ['label' => 'Active', 'value' => 'active'],
                ['label' => 'Inactive', 'value' => 'inactive'],
            ],
        ];

        return $data[$key] ?? null;
    }
}
