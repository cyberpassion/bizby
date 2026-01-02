<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shared\Helpers\PleskHelper;
use Illuminate\Support\Facades\Validator;

class PleskDatabaseApiController extends Controller
{
    /* ---------------------------------
     | Create Database
     |----------------------------------*/
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64|regex:/^[a-zA-Z0-9_]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid database name',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $result = PleskHelper::createBlankDatabase($request->name);

        if ($result['status'] === true) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Database created successfully',
                'data'    => $result['response'],
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => $result['response'],
        ], 400);
    }

    /* ---------------------------------
     | Delete Database
     |----------------------------------*/
    public function destroy(string $name)
    {
        $deleted = PleskHelper::deletePleskDatabase($name);

        if (! $deleted) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Database not found or deletion failed',
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Database deleted successfully',
        ]);
    }
}
