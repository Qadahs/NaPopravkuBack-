<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function get(Request $request)
    {
       auth()->user()->tokens()->delete();
       return response(['message'=>'Logged out'],201);
    }
}
