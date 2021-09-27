<?php

namespace App\Http\Controllers\PublicData;

use App\Models\Articles;
use App\Models\UserArticle;
use App\Modules\Rest\Data\Components\Article\ArticleDataTemplate;
use App\Modules\Rest\Data\Components\Article\Filters\UserFilter;
use App\Modules\Rest\Data\Components\FilterParser;
use App\Modules\Rest\Data\DataTemplator;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PublicArticleController
{
    public function get(Request $request,ArticleDataTemplate $articleDataTemplate)
    {
       $filter = FilterParser::parse($request);
       $articleDataTemplate->setFilters($filter);
       DataTemplator::data($articleDataTemplate);
       RestResponse::response();
    }
}
