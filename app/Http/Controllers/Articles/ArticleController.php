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
        $articleDataTemplate->setPage($request->input('page'));
        $articleDataTemplate->setArticles(UserArticle::all());
        $data = DataTemplator::data($articleDataTemplate);
        if(isset($data['errors'])) return RestResponse::response(1,[],[$data['errors']]);
        return RestResponse::response(201,$data);
    }
}
