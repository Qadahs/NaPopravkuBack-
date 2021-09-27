<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\Components\LoginError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $isAuth = Auth::attempt($credentials);
        if (!$isAuth) {
            ErrorTemplator::error(LoginError::class);
        }
        $user = auth()->user();
        $token = $user->createToken('secretToken')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        RestResponse::addData($data);
        RestResponse::response();
    }
}
