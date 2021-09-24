<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Modules\Rest\RestResponse;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function get(Request $request)
    {
       auth()->user()->tokens()->delete();
       return RestResponse::response(201);
    }
}
