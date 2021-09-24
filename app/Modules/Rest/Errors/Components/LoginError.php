<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ApplicationErrorInterface;

class LoginError implements ApplicationErrorInterface
{
    public static function getError()
    {
        return ["LoginError"=>'Не удалось авторизовать пользователя'];
    }
    public static function getMessage()
    {
        return "Не удалось авторизовать пользователя";
    }


}
