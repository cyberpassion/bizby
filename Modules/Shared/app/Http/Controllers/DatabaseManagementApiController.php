<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use Modules\Admin\Services\Tenants\TenantDatabaseService;
use Modules\Shared\Responses\ApiResponse;

class DatabaseManagementApiController extends Controller
{
    public function __construct(
        protected TenantDatabaseService $dbService
    ) {}

    /* ---------------------------------
     | Create Database
     |----------------------------------*/
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64|regex:/^[a-zA-Z0-9_]+$/',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation(
                $validator->errors()
            );
        }

        try {
            $this->dbService->create($request->name);

            return ApiResponse::store(
                null,
                'Database created successfully'
            );

        } catch (\Throwable $e) {
            return ApiResponse::error(
                'Database creation failed',
                500,
                app()->isLocal() ? $e->getMessage() : null
            );
        }
    }

    /* ---------------------------------
     | Delete Database
     |----------------------------------*/
    public function destroy(string $name)
    {
        try {
            $deleted = $this->dbService->delete($name);

            if (! $deleted) {
                return ApiResponse::notFound(
                    'Database not found or deletion failed'
                );
            }

            return ApiResponse::delete(
                'Database deleted successfully'
            );

        } catch (\Throwable $e) {
            return ApiResponse::error(
                'Database deletion failed',
                500,
                app()->isLocal() ? $e->getMessage() : null
            );
        }
    }
}
