<?php

namespace App\Modules\Rest\Errors\Components;

use App\Modules\Rest\Errors\ErrorInterface;

class AddArticleError implements ErrorInterface
{
    public static function getError()
    {
      return ['add'=>['Не удалось добавить запись']];
    }

    public static function getMessage()
    {
       return 'Не удалось добавить запись';
    }

    public static function getCode()
    {
        return 404;
    }


}
