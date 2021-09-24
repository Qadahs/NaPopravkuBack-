<?php

namespace App\Modules\Rest\Data;

use App\Modules\Rest\Data\Components\ArticleDataTemplate;
use Illuminate\Support\Facades\Log;

class DataTemplator
{
    public static function data(DataTemplateInterface $object)
    {
        $object->validate();
        $object->bootstrap();
        try
        {
            return $object->template();
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return [];
        }
    }
}
