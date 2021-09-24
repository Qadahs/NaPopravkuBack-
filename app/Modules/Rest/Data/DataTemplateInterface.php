<?php

namespace App\Modules\Rest\Data;

interface DataTemplateInterface
{
    public function validate();
    public function bootstrap();
    public function template();
}
