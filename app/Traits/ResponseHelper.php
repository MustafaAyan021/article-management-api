<?php

namespace App\Traits;

trait ResponseHelper
{
  public function successResponse($data, $message = '', $status = 200)
  {
    return response()->json([
      'message' => $message,
      'status' => $status,
      'data' => $data,
    ]);
  }

  public function errorResponse($data, $message = '', $status = 400)
  {
    return response()->json([
      'message' => $message,
      'status' => $status,
    ]);
  }
};
