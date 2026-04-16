<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceBatch;

class AttendanceBatchApiController extends Controller
{

    public function index()
    {
        $batches = AttendanceBatch::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => ['data' => $batches]
        ]);
    }


    public function store(Request $request)
    {
        $batch = AttendanceBatch::create([
            'tenant_id' => tenant()->id,
            'name' => $request->name,
            'code' => $request->code,
            'academic_year' => $request->academic_year,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? 1
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $batch
        ]);
    }


    public function show($id)
    {
        $batch = AttendanceBatch::with('participants')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $batch
        ]);
    }


    public function update(Request $request, $id)
    {
        $batch = AttendanceBatch::findOrFail($id);

        $batch->update($request->only([
            'name',
            'code',
            'academic_year',
            'start_date',
            'end_date',
            'status'
        ]));

        return response()->json([
            'status' => 'success',
            'data' => $batch
        ]);
    }


    public function destroy($id)
    {
        AttendanceBatch::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Batch deleted'
        ]);
    }
}