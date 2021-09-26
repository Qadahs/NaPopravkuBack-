<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ErrorInterface;
use App\Modules\Rest\RestResponse;

class LoginError implements ErrorInterface
{
    public static function getError()
    {
        return ["LoginError"=>'Не удалось авторизовать пользователя'];
    }
    public static function getMessage()
    {
        return "Не удалось авторизовать пользователя";
    }
    public static function getCode()
    {
        return 417;
    }
}
