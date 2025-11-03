<?php

namespace Modules\Consultation\Services;

use Modules\Consultation\Models\Consultation;

class ConsultationService
{
    public function list()
    {
        return Consultation::latest()->get();
    }

    public function paginate($limit = 10)
    {
        return Consultation::latest()->paginate($limit);
    }

    public function find($id)
    {
        return Consultation::findOrFail($id);
    }

    public function create(array $data)
    {
        return Consultation::create($data);
    }

    public function update($id, array $data)
    {
        $consultation = $this->find($id);
        $consultation->update($data);
        return $consultation;
    }

    public function delete($id)
    {
        $consultation = $this->find($id);
        return $consultation->delete();
    }
}
