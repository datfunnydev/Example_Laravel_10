<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    public function success(string $message = '', $data = null): JsonResponse
    {
        return response()->json([
            'status' => true,
            'title' => __('Thành công'),
            'message' => __($message),
            'data' => $data,
        ]);
    }

    public function question(string $message = '', $data = null): JsonResponse
    {
        return response()->json([
            'status' => true,
            'title' => __('Câu hỏi'),
            'message' => __($message),
            'data' => $data,
        ]);
    }

    public function error(string $message = '', $data = null, int $code = 200): JsonResponse
    {
        if (! $message) {
            $message = __('Có lỗi xảy ra, vui lòng kiểm tra lại');
        }

        return response()->json([
            'status' => false,
            'title' => __('Thất bại'),
            'message' => __($message),
            'data' => $data,
        ], $code);
    }
}
