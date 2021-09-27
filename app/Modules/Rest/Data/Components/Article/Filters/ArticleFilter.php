<?php

namespace App\Modules\Rest\Data\Components\Article\Filters;

use App\Modules\Rest\Data\Components\FilterInterface;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use Illuminate\Http\Request;

class ArticleFilter implements FilterInterface
{
    private $id;
    public function filter($model)
    {
        return $model->where('articles_id',$this->id);
    }

    public function injectData(Request $request)
    {
        $id  = $request->input('filters.article');
        if(!$id)
        {
            ErrorTemplator::error(ServerError::class);
        }
        $this->id=$id;
    }

}
