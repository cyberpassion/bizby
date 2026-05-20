<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\EmployeeEducationHistory;

class EmployeeEducationHistoryApiController extends Controller
{
    public function index($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        return response()->json([
            'success' => true,
            'message' => 'Education histories fetched successfully',
            'data' => $employee->educationHistories,
        ]);
    }

    public function store(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        $educationHistory = $employee
            ->educationHistories()
            ->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Education history created successfully',
            'data' => $educationHistory,
        ], 201);
    }

    public function show($employeeId, $id)
    {
        $educationHistory = EmployeeEducationHistory::where(
            'employee_id',
            $employeeId
        )->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Education history fetched successfully',
            'data' => $educationHistory,
        ]);
    }

    public function update(Request $request, $employeeId, $id)
    {
        $educationHistory = EmployeeEducationHistory::where(
            'employee_id',
            $employeeId
        )->findOrFail($id);

        $educationHistory->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Education history updated successfully',
            'data' => $educationHistory,
        ]);
    }

    public function destroy($employeeId, $id)
    {
        $educationHistory = EmployeeEducationHistory::where(
            'employee_id',
            $employeeId
        )->findOrFail($id);

        $educationHistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education history deleted successfully',
        ]);
    }
}
