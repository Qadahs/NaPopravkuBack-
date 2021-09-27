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
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
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
    public function delete(Request $request)
    {
        $id = (int)$request->input('id');
        if($id)
        {
            try {
                if(UserArticle::where('articles_id',$id)->first()->user->id === $request->user()->id)
                {
                    Articles::where('id',$id)->delete();
                    RestResponse::response();
                }
            }
            catch (\Exception $e)
            {
                ErrorTemplator::error(ServerError::class);
            }
        }
        ErrorTemplator::error(ServerError::class);
    }
}
