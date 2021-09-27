<?php

namespace App\Modules\Rest\Data\Components\Article\Filters;

use App\Models\ArticleTag;
use App\Modules\Rest\Data\Components\FilterInterface;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use Illuminate\Http\Request;

class TagFilter implements FilterInterface
{
    private $tags = [];
    public function filter($model)
    {
        if(!count($this->tags)) return $model;
        $articleTags = new ArticleTag;
        $articleTags = $articleTags
            ->whereIn('tags_id', $this->tags)
            ->groupBy('articles_id')
            ->havingRaw('count(distinct tags_id) = ?', [count($this->tags)])
            ->get('articles_id');
        $articlesId = [];
        foreach ($articleTags as $articleTag) {
            $articlesId[] = $articleTag->articles_id;
        }
        return $model->whereIn('articles_id', $articlesId);
    }
    public function injectData(Request $request)
    {
        $tags = $request->input('filters.tags');
        if (!$tags) {
           ErrorTemplator::error(ServerError::class);
        }
        $this->setTags($tags);
    }

    private function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

}
