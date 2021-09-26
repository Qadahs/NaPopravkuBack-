<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\User;
use App\Models\UserArticle;

use App\Modules\Rest\Data\Components\Article\ArticleDataTemplate;
use App\Modules\Rest\Data\Components\Article\Filters\UserFilter;
use App\Modules\Rest\Data\Components\FilterParser;
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
    public function filter(Request $request,ArticleDataTemplate $articleDataTemplate)
    {
//        $test = new UserArticle;
//        $test = $test->join('users','user_article.users_id','=','users.id');
//        dd($test->getQuery()->joins[0]->table);
       // dd(UserArticle::where('users_id','qadahs')->join('users','user_article.users_id','=','users.id')->get());
        $page = $request->input('page');
        if($page)
        {
            $articleDataTemplate->setPage((int)$page);
        }
        $filters = FilterParser::parse($request);
        $articleDataTemplate->setFilters($filters);
        DataTemplator::data($articleDataTemplate);
        RestResponse::response();
    }
}
