<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\EmployeeWorkHistory;

class EmployeeWorkHistoryApiController extends Controller
{
    public function index($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        return response()->json([
            'success' => true,
            'message' => 'Work histories fetched successfully',
            'data' => $employee->workHistories,
        ]);
    }

    public function store(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        $workHistory = $employee
            ->workHistories()
            ->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Work history created successfully',
            'data' => $workHistory,
        ], 201);
    }

    public function show($employeeId, $id)
    {
        $workHistory = EmployeeWorkHistory::where(
            'employee_id',
            $employeeId
        )->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Work history fetched successfully',
            'data' => $workHistory,
        ]);
    }

    public function update(Request $request, $employeeId, $id)
    {
        $workHistory = EmployeeWorkHistory::where(
            'employee_id',
            $employeeId
        )->findOrFail($id);

        $workHistory->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Work history updated successfully',
            'data' => $workHistory,
        ]);
    }

    public function destroy($employeeId, $id)
    {
        $workHistory = EmployeeWorkHistory::where(
            'employee_id',
            $employeeId
        )->findOrFail($id);

        $workHistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Work history deleted successfully',
        ]);
    }
}
