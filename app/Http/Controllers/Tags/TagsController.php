<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Modules\Rest\Data\Components\ArticleDataTemplate;
use App\Modules\Rest\Data\Components\TagDataTemplate;
use App\Modules\Rest\Data\DataTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function get(TagDataTemplate $tagDataTemplate)
    {
        return RestResponse::response(200,DataTemplator::data($tagDataTemplate));
    }
}
