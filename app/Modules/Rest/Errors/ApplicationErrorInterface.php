<?php

namespace App\Modules\Rest\Errors;

interface ApplicationErrorInterface
{
    public static function getError();
    public static function getMessage();
}
