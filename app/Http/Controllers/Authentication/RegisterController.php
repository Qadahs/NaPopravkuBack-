<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\ApplicationErrors;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $credentials = $request->validate([
            'login'=>['required','string'],
            'password'=>['required','string','confirmed'],
        ]);
        $user = User::create([
            'login'=>$credentials['login'],
            'password'=>$credentials['password'],
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        if(!$user)
        {
            return RestResponse::response(417,[],['register']);
        };
        $token = $user->createToken('secretToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token,
        ];
        return RestResponse::response(201,$response);
    }
}
