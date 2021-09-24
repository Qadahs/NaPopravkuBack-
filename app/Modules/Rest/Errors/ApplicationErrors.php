<?php

namespace App\Modules\Rest\Errors;

use App\Modules\Rest\Errors\Components\DefaultError;
use App\Modules\Rest\Errors\Components\LoginError;
use App\Modules\Rest\Errors\Components\PageError;
use App\Modules\Rest\Errors\Components\RegistrationError;

class ApplicationErrors
{
    public static function sendError(array $errors = [])
    {
        if(!count($errors)) return null;
        $errorsArray = [];
        foreach ($errors as $error)
        {
            switch ($error)
            {
                case 'register':
                {
                    self::getData($errorsArray,RegistrationError::class);
                    break;
                }
                case 'login':
                {
                    self::getData($errorsArray,LoginError::class);
                    break;
                }
                case 'page':
                {
                    self::getData($errorsArray,PageError::class);
                    break;
                }
                default: {
                    self::getData($errorsArray,DefaultError::class);
                    break;
                }
            }
        }
        return $errorsArray;

    }
    private static function getData(&$arr,$class)
    {
        $arr["errors"][]=$class::getError();
        $arr["messages"][]=$class::getMessage();
        $arr["codes"][]=$class::getCode();
    }
}
