<?php

namespace Modules\Employee\Services;

use Modules\Employee\Models\Employee;

class EmployeeService
{
    public function list()
    {
        return Employee::latest()->get();
    }

    public function paginate($limit = 10)
    {
        return Employee::latest()->paginate($limit);
    }

    public function find($id)
    {
        return Employee::findOrFail($id);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update($id, array $data)
    {
        $employee = $this->find($id);
        $employee->update($data);
        return $employee;
    }

    public function delete($id)
    {
        $employee = $this->find($id);
        return $employee->delete();
    }
}
