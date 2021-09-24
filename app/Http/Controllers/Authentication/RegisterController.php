<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\ApplicationErrors;
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
        rest(417, [], ApplicationErrors::sendError(['register']));
        };
        $token = $user->createToken('secretToken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token,
        ];
        return response($response,201);
    }
}
