<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Modules\Rest\RestResponse;


class AuthController extends Controller
{
    public function get()
    {
        $user = auth()->user();
        $data = [
            'user' => $user
        ];
        RestResponse::addData($data);
        RestResponse::response();
    }
}
