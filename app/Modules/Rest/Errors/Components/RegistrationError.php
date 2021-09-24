<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ApplicationErrorInterface;

class RegistrationError implements ApplicationErrorInterface
{
    public static function getError()
    {
       return ['RegistrationError'=>'Не удалось зарегестрировать пользователя'];
    }
    public static function getMessage()
    {
        return "Не удалось зарегестрировать пользователя";
    }
}
