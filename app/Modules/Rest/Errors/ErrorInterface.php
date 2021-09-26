<?php

namespace App\Modules\Rest\Errors;

interface ErrorInterface
{
    public static function getError();
    public static function getMessage();
    public static function getCode();
}
