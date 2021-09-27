<?php

namespace App\Http\Controllers\PublicData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;

class PublicAccountController extends Controller
{
    public function get(Request $request)
    {
        $login  = $request->input('login');
        if(!$login)
        {
            ErrorTemplator::error(ServerError::class);
        }
        try{
            $user = User::where('login',$login)->first();
            RestResponse::addData(['user'=>$user]);
            RestResponse::response();
        }
        catch (\Exception $e)
        {
            ErrorTemplator::error(ServerError::class);
        }

    }
}
