<?php

namespace App\Modules\Rest\Errors;

use App\Modules\Rest\Errors\Components\DefaultError;
use App\Modules\Rest\Errors\Components\LoginError;
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
                    $errorsArray["errors"][]=RegistrationError::getError();
                    $errorsArray["messages"][]=RegistrationError::getMessage();
                    break;
                }
                case 'login':
                {
                    $errorsArray["errors"][]=LoginError::getError();
                    $errorsArray["messages"][]=LoginError::getMessage();
                    break;
                }
                default: {
                    $errorsArray["errors"][]=DefaultError::getError();
                    $errorsArray["messages"][]=DefaultError::getMessage();
                    break;
                }
            }
        }
        return $errorsArray;

    }
}
