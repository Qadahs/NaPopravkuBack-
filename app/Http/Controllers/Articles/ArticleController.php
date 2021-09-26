<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\User;
use App\Models\UserArticle;
use App\Modules\Rest\Data\Components\ArticleDataTemplate;
use App\Modules\Rest\Data\DataTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function get(Request $request,ArticleDataTemplate $articleDataTemplate)
    {
        $page = $request->input('page');
        if($page)
        {
            $articleDataTemplate->setPage((int)$page);
        }
        DataTemplator::data($articleDataTemplate);
        RestResponse::response();
    }
}
