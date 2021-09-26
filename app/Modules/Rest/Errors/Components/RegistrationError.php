<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ErrorInterface;

class RegistrationError implements ErrorInterface
{
    public static function getError()
    {
       return ['RegistrationError'=>'Не удалось зарегестрировать пользователя'];
    }
    public static function getMessage()
    {
        return "Не удалось зарегестрировать пользователя";
    }
    public static function getCode()
    {
        return 417;
    }
}
