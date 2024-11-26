<?php

namespace App\Http;


if (!function_exists('test')) {
    function ApiResponse($status, $message, $data = null)
    {
        $response = ['status' => $status,'message' => $message];

        if ($data != null) { $response['data'] = $data;}

        return response()->json($response, $status);
    }
};
