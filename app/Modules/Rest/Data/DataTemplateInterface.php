<?php

namespace App\Modules\Rest\Data;

interface DataTemplateInterface
{
    public function bootstrap();
    public function validate();
    public function template();
}
