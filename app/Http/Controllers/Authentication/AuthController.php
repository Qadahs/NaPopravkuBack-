<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Modules\Rest\RestResponse;
use http\Env\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function get()
    {
        $user = auth()->user();
        $data = [
            'user'=>$user
        ];
        return RestResponse::response(200,$data);
    }
}
