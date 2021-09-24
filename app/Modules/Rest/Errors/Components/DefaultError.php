<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ApplicationErrorInterface;

class DefaultError implements ApplicationErrorInterface
{
    public static function getError()
    {
        return ['ServerError'=>'Ошибка на сервере'];
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
