<?php

namespace App\Modules\Rest\Data\Components;

use App\Models\UserArticle;
use App\Modules\Rest\Data\DataTemplateInterface;

class ArticleDataTemplate implements DataTemplateInterface
{
    private $page = 0;
    private $articles;

    public function validate()
    {
       //pagevalidation
    }
    public function bootstrap()
    {
        if(!$this->page)
        {
            $this->articles=$this->getListOfArticles();
        }
    }
    public function template()
    {
        $response = [];
        $_index = 0;
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

    private function getListOfArticles()
    {
        return UserArticle::all();
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
        if($page)
        {
            $this->page = $page;
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


}
