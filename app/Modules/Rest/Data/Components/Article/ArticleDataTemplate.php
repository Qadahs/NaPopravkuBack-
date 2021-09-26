<?php

namespace App\Modules\Rest\Data\Components\Article;

use App\Models\User;
use App\Models\UserArticle;
use App\Modules\Rest\Data\Components\Article\Filters\UserFilter;
use App\Modules\Rest\Data\Components\FilterInterface;
use App\Modules\Rest\Data\DataTemplateInterface;
use App\Modules\Rest\Data\DataTemplator;
use App\Modules\Rest\Errors\Components\IncorrectPageError;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;

class ArticleDataTemplate implements DataTemplateInterface
{
    private $page = 1;
    private $articles;
    private $pagesCount = 1;
    private $filters = [];

    public function validate()
    {
        $this->pagesCount = $this->getPagesCount();
        if ($this->page > $this->pagesCount) {
            ErrorTemplator::error(IncorrectPageError::class);
        }
    }

    public function bootstrap()
    {
        if (count($this->filters) === 0) {
            $userArticle = new UserArticle;
            $this->articles = $this->getPageArticle($userArticle, $this->page);
            return;
        }
        $articles = $this->filter();
        $this->articles = $this->getPageArticle($articles, $this->page);
    }

    public function filter()
    {
        $userArticle = new UserArticle;
        foreach ($this->filters as $filter) {
            $userArticle = $filter->filter($userArticle);
        }
        return $userArticle;
    }

    public function template()
    {
        $body = [];
        foreach ($this->articles as $article) {
            $singleArticle = [
                'id' => $article->id,
                'user' => [
                    'id' => $article->user->id,
                    'login' => $article->user->login,
                ],
                'article' => [
                    'id' => $article->article->id,
                    'text' => $this->getText($article->article->id),
                    'created_at' => $article->article->created_at,
                    'tags' => []
                ]
            ];
            foreach ($article->article->tags as $tag) {
                $singleArticle['article']['tags'][] = [
                    'id' => $tag->tag->id,
                    'title' => $tag->tag->title,
                ];
            }
            $body['articles'][] = $singleArticle;
        }
        $body['pagesCount'] = $this->pagesCount;
        RestResponse::addData($body);
    }

    private function getText($id)
    {
        try {
            $text = Redis::hget('articles', $id);
            return $text ? $text : '';
        } catch (\Exception $e) {
            ErrorTemplator::error(ServerError::class);
        }
    }

    private function getPageArticle($userArticle, $page)
    {
        try {
            return $userArticle->skip(($page - 1) * 10)->take(10)->orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            ErrorTemplator::error(ServerError::class);
        }
    }

    private function getPagesCount()
    {
        if (count($this->filters) === 0) {
            try {
                return (int)ceil(UserArticle::all()->count() / 10);
            } catch (\Exception $e) {
                ErrorTemplator::error(ServerError::class);
            }
        }
        return (int)ceil( $this->filter()->get()->count() / 10);
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $correctFilters = array_filter($filters, function ($class) {
            return $class instanceof FilterInterface;
        });
        $this->filters = $correctFilters;
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
        if ($page != 0) {
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
