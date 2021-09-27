<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\ArticleTag;
use App\Models\UserArticle;
use App\Modules\Rest\Errors\Components\AddArticleError;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ArticleAddController extends Controller
{
    public function post(Request $request)
    {
        $credentials = $request->validate([
            'text'=>['required','string'],
            'id'=>['required','integer'],
            'tags'=>['required']
        ]);
        try{
            $this->insertArticle(
                $credentials['text'],
                $credentials['id'],
                $credentials['tags'],
            );
        }
        catch (\Exception $e){
          ErrorTemplator::error(AddArticleError::class);
        }
        RestResponse::response();
    }
    private function insertArticle($text,$id,$tags)
    {
    DB::transaction(function() use ($text,$id,$tags){
        $article = Articles::create([
            'created_at'=>now()
        ]);
        Redis::hset('articles',$article->id,$text);
        $articlePost = UserArticle::create([
            'users_id'=>$id,
            'articles_id'=>$article->id
        ]);
        foreach ($tags as $tag)
        {
            ArticleTag::create([
                'articles_id'=>$article->id,
                'tags_id'=>$tag
            ]);
        }
    });
    }
}
