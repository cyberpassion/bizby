<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\EmployeeWorkHistory;

class EmployeeWorkHistoryApiController extends Controller
{
    public function index(Employee $employee)
    {
        return $employee->workHistories;
    }

    public function store(Request $request, Employee $employee)
    {
        return $employee
            ->workHistories()
            ->create($request->all());
    }

    public function show(Employee $employee, EmployeeWorkHistory $workHistory)
    {
        return $workHistory;
    }

    public function update(
        Request $request,
        Employee $employee,
        EmployeeWorkHistory $workHistory
    ) {
        $workHistory->update($request->all());

        return $workHistory;
    }

    public function destroy(
        Employee $employee,
        EmployeeWorkHistory $workHistory
    ) {
        $workHistory->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}
