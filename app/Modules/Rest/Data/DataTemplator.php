<?php

namespace App\Modules\Rest\Data;

use App\Modules\Rest\Data\Components\ArticleDataTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class DataTemplator
{
    public static function data($object)
    {
        $object->validate();
        $object->bootstrap();
        $object->template();
    }
}
