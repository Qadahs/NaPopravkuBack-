<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\Components\RegistrationError;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string', 'min:4', 'max:40'],
            'password' => ['required', 'string', 'confirmed', 'min:4', 'max:40'],
        ]);
        $user = null;
        try {
            $user = User::create([
                'login' => $credentials['login'],
                'password' => $credentials['password'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            ErrorTemplator::error(ServerError::class);
        }
        if (!$user) {
            ErrorTemplator::error(RegistrationError::class);
        };
        $token = $user->createToken('secretToken')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        RestResponse::addData($data);
        RestResponse::response();
    }
}
