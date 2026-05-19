<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\EmployeeEducationHistory;

class EmployeeEducationHistoryApiController extends Controller
{
    public function index(Employee $employee)
    {
        return $employee->educationHistories;
    }

    public function store(Request $request, Employee $employee)
    {
        return $employee
            ->educationHistories()
            ->create($request->all());
    }

    public function show(Employee $employee, EmployeeEducationHistory $educationHistory)
    {
        return $educationHistory;
    }

    public function update(
        Request $request,
        Employee $employee,
        EmployeeEducationHistory $educationHistory
    ) {
        $educationHistory->update($request->all());

        return $educationHistory;
    }

    public function destroy(
        Employee $employee,
        EmployeeEducationHistory $educationHistory
    ) {
        $educationHistory->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}
