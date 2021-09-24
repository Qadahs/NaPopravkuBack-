<?php

namespace App\Modules\Rest\Data\Components;

use App\Models\UserArticle;
use App\Modules\Rest\Data\DataTemplateInterface;
use App\Modules\Rest\RestResponse;
use Illuminate\Support\Facades\Redis;

class ArticleDataTemplate implements DataTemplateInterface
{
    private $page = 1;
    private $articles;
    private $pagesCount=1;
    public function validate()
    {
       if($this->page>$this->pagesCount)
       {
           return 'page';
       }
       return null;
    }
    public function bootstrap()
    {

        $this->articles=$this->getPageArticle($this->page);
    }
    public function template()
    {
        $response = [];
       foreach ($this->articles as $article)
       {

           $singleArticle = [
               'id'=>$article->id,
               'user'=>[
                  'id'=>$article->user->id,
                  'login'=>$article->user->login,
                ],
                'article'=>[
                  'id'=>$article->article->id,
                    'text'=>$this->getText($article->article->id),
                    'created_at'=>$article->article->created_at?$article->article->created_at:'',
                   'tags'=>[]
                ]
           ];
           foreach ($article->article->tags as $tag)
           {
               $singleArticle['article']['tags'][]=[
                   'id'=>$tag->tag->id,
                   'title'=>$tag->tag->title,
               ];
           }
           $response['articles'][] =$singleArticle;
       }
        return $response;
    }
    private function getText($id)
    {
       $text =  Redis::hget('articles',$id);
       return $text?$text:'';
    }
    private function getListOfArticles()
    {
        return UserArticle::all();
    }
    private function getPageArticle($page)
    {

        $test = UserArticle::skip(($page-1)*10)->take(10)->orderBy('id', 'desc')->get();

        return $test;

    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page): void
    {
        if(is_int((int)$page) && (int)$page)
        {
            $this->page = (int)$page;
        }

    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles): void
    {
        $this->articles = $articles;
    }

    /**
     * @return int
     */
    public function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    /**
     * @param int $pagesCount
     */
    public function setPagesCount(int $pagesCount): void
    {
        $this->pagesCount = $pagesCount;
    }


}
