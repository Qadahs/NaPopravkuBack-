<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\ApplicationErrors;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $credentials = $request->validate([
            'login'=>['required','string'],
            'password'=>['required','string'],
        ]);
        $isAuth = Auth::attempt($credentials);

        if(!$isAuth)
        {
            return RestResponse::response(417,[],['login']);
        };
        $user = auth()->user();
        $token = $user->createToken('secretToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token,
        ];
        return RestResponse::response(201,$response);
    }
}
