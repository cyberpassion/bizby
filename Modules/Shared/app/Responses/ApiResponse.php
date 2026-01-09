<?php

namespace Modules\Shared\Responses;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ApiResponse
{
    /* ---------------------------------
     | Basic Success / Error
     |----------------------------------*/
    public static function success(
        mixed $data = null,
        string $message = 'Success',
        int $statusCode = 200,
        array $meta = []
    ): JsonResponse {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
            'meta'    => (object) $meta,
        ], $statusCode);
    }

    public static function error(
        string $message = 'Error',
        int $statusCode = 400,
        mixed $errors = null
    ): JsonResponse {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $statusCode);
    }

    /* ---------------------------------
     | STORE
     |----------------------------------*/
    public static function store(
        mixed $data,
        string $message = 'Created successfully'
    ): JsonResponse {
        return self::success($data, $message, 201);
    }

    /* ---------------------------------
     | UPDATE
     |----------------------------------*/
    public static function update(
        mixed $data,
        string $message = 'Updated successfully'
    ): JsonResponse {
        return self::success($data, $message);
    }

    /* ---------------------------------
     | DELETE
     |----------------------------------*/
    public static function delete(
        string $message = 'Deleted successfully'
    ): JsonResponse {
        return self::success(null, $message);
    }

    /* ---------------------------------
     | INDEX / LIST (Pagination aware)
     |----------------------------------*/
    public static function index(
        Collection|LengthAwarePaginator $data,
        string $message = 'Data fetched successfully'
    ): JsonResponse {
        // Pagination response
        if ($data instanceof LengthAwarePaginator) {
            return response()->json([
                'status'  => 'success',
                'message' => $message,
                'data'    => $data->items(),
                'meta'    => [
                    'current_page' => $data->currentPage(),
                    'last_page'    => $data->lastPage(),
                    'per_page'     => $data->perPage(),
                    'total'        => $data->total(),
                ],
            ]);
        }

        // Normal list
        return self::success($data, $message);
    }

    /* ---------------------------------
     | SHOW
     |----------------------------------*/
    public static function show(
        mixed $data,
        string $message = 'Data fetched successfully'
    ): JsonResponse {
        return self::success($data, $message);
    }

    /* ---------------------------------
     | VALIDATION ERROR
     |----------------------------------*/
    public static function validation($errors): JsonResponse
    {
        return self::error(
            'Validation failed',
            422,
            $errors
        );
    }

    /* ---------------------------------
     | NOT FOUND
     |----------------------------------*/
    public static function notFound(
        string $message = 'Resource not found'
    ): JsonResponse {
        return self::error($message, 404);
    }

    /* ---------------------------------
     | UNAUTHORIZED / FORBIDDEN
     |----------------------------------*/
    public static function unauthorized(
        string $message = 'Unauthorized'
    ): JsonResponse {
        return self::error($message, 401);
    }

    public static function forbidden(
        string $message = 'Forbidden'
    ): JsonResponse {
        return self::error($message, 403);
    }
}
