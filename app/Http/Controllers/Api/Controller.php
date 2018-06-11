<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function response($data, $code = 0, $msg = '')
    {
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ]);
    }
}
