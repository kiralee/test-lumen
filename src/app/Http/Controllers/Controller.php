<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param int $statusCode
     * @param array $data
     * @param $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function setResponse(int $statusCode, array $data = [], $exception = null):\Illuminate\Http\JsonResponse
    {
        $errorMessage = "";
        if($exception) {
            $errorMessage = $exception->getMessage();
            if (App::environment("production")) {
                $errorMessage = "Something went wrong";
            }
            Log::critical($exception->getMessage());
        }
        $jsonResult['data'] = $data;
        $jsonResult['error'] = [
            'message' => $errorMessage
        ];

        return response()->json($jsonResult, $statusCode);
    }
}
