<?php

namespace App\Modules\Rest\Errors;

use App\Modules\Rest\Errors\Components\AddArticleError;
use App\Modules\Rest\Errors\Components\IncorrectPageError;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\Components\LoginError;
use App\Modules\Rest\Errors\Components\RegistrationError;
use App\Modules\Rest\RestResponse;

class ErrorTemplator
{
    private static $errors =
        [
            ServerError::class,
            LoginError::class,
            RegistrationError::class,
            IncorrectPageError::class,
            AddArticleError::class
        ];

    public static function error($errorType)
    {
        foreach (self::$errors as $error) {
            if ($error === $errorType) {
                self::setBody($error);
            }
        }
        self::setBody(ServerError::class);
    }

    private static function setBody($class)
    {
        RestResponse::setCode($class::getCode());
        RestResponse::setMessage($class::getMessage());
        RestResponse::setError($class::getError());
    }
}
