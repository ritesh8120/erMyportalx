<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse($data): JsonResponse
    {
        $data['success'] = true;
        return response()->json($data, 200);
    }

    public function errorResponse($message) : JsonResponse {
        return response()->json($message, 500);
    }
}
