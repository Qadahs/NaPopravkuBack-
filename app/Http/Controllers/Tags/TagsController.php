<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Modules\Rest\Data\Components\Tag\TagDataTemplate;
use App\Modules\Rest\Data\DataTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function get(TagDataTemplate $tagDataTemplate)
    {
        DataTemplator::data($tagDataTemplate);
        RestResponse::response();
    }
}
