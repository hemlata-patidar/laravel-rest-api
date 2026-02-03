<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected function success($data = [], string $message = "Operation successful", int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $status);
    }

    protected function error(string $message = "Operation failed", int $status = 400, $data = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $status);
    }
}
