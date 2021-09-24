<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\ApplicationErrors;
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
            return rest(417,[],ApplicationErrors::sendError(['login']));
        };
        $user = auth()->user();
        $token = $user->createToken('secretToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token,
        ];
        return rest(201,$response);
    }
}
