<?php

namespace App\Modules\Rest\Data\Components;



use Illuminate\Http\Request;

interface FilterInterface
{
    public function filter($model);
    public function injectData(Request $request);
}
