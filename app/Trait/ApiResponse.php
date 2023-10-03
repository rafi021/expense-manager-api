<?php

namespace App\Trait;

trait ApiResponse
{
    public function ResponseSuccess($data, $metadata = null, $message="Successfull", $status_code = 200, $status = 'success')
    {
       return response()->json([
        'status' => $status,
        'status_code' => $status_code,
        'message' => $message,
        'data' => $data,
        'metadata' => $metadata,
       ]);
    }

    public function ResponseError($errors, $metadata = null, $message="Data Process Error", $status_code = 400, $status = 'error')
    {
       return response()->json([
        'status' => $status,
        'status_code' => $status_code,
        'message' => $message,
        'errors' => $errors,
        'metadata' => $metadata,
       ]);
    }

    public function ResponseInfo($info, $metadata = null, $message="Notification!", $status_code = 200, $status = 'info')
    {
       return response()->json([
        'status' => $status,
        'status_code' => $status_code,
        'message' => $message,
        'info' => $info,
        'metadata' => $metadata,
       ]);
    }
}
