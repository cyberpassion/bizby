<?php
namespace Modules\Consultation\Providers;

class ConsultationLookupProvider
{
    public function getLookups()
    {
        return [
            'doctor' => fn() => $this->doctors()
        ];
    }

    protected function doctors()
    {
        return ['employee-1'=>'Ravi Sharma','employee-2'=>'Shyam Sharma','employee-3'=>'Rani Sharma'];
    }
}
