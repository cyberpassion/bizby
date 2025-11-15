<?php

namespace Modules\Consultation\Formatters;

use Modules\Consultation\Models\Consultation;

class ConsultationFormatter
{
    public static function format(Consultation $consultation)
    {
		$data = $consultation->toArray();
		// Only override fields that need formatting
        if (isset($data['consultation_date'])) {
            $data['consultation_date'] = $consultation->consultation_date->format('d M Y');
        }
        // Optional: doctor_name from relationship
        $data['doctor_name'] = $consultation->doctor?->name ?? '-';
        // Optional: status label
        $data['status_label'] = $consultation->status == 1 ? 'Completed' : 'Pending';
        return $data;
    }
}
