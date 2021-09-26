<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ErrorInterface;

class IncorrectPageError implements ErrorInterface
{
    public static function getError()
    {
        return ['page'=>['Такой страницы не существует']];
    }

    public static function getMessage()
    {
        return 'Такой страницы не существует';
    }

    public static function getCode()
    {
        return 404;
    }

}
