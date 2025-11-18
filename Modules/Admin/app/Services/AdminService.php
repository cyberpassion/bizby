<?php

namespace Modules\Admin\Services;

use Modules\Admin\Models\Admin;

class AdminService
{
    public function list()
    {
        return Admin::latest()->get();
    }

    public function paginate($limit = 10)
    {
        return Admin::latest()->paginate($limit);
    }

    public function find($id)
    {
        return Admin::findOrFail($id);
    }

    public function create(array $data)
    {
        return Admin::create($data);
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
