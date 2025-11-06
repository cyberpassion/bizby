<?php

namespace Modules\Shared\Services;

use Modules\Shared\Models\Shared;

class SharedService
{
    public function list()
    {
        return Shared::latest()->get();
    }

    public function paginate($limit = 10)
    {
        return Shared::latest()->paginate($limit);
    }

    public function find($id)
    {
        return Shared::findOrFail($id);
    }

    public function create(array $data)
    {
        return Shared::create($data);
    }

    public function update($id, array $data)
    {
        $shared = $this->find($id);
        $shared->update($data);
        return $shared;
    }

    public function delete($id)
    {
        $shared = $this->find($id);
        return $shared->delete();
    }
}
