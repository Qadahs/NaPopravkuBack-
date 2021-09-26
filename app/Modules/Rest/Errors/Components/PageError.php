<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ErrorInterface;

class PageError implements ErrorInterface
{
    public static function getError()
    {
        return ['PageError'=>'Страницы не существует'];
    }

    public static function getMessage()
    {
        return 'Страницы не существует';
    }

    public static function getCode()
    {
        return 417;
    }
}
