<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ErrorInterface;
use App\Modules\Rest\RestResponse;
use Illuminate\Support\Facades\App;

class ServerError implements ErrorInterface
{
    public static function getError()
    {
        return ['server'=>['Ошибка на сервере']];
    }
    public static function getMessage()
    {
        return "Ошибка на сервере";
    }
    public static function getCode()
    {
       return 500;
    }

}
