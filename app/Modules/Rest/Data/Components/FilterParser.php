<?php

namespace App\Modules\Rest\Data\Components;

use App\Modules\Rest\Data\Components\Article\Filters\ArticleFilter;
use App\Modules\Rest\Data\Components\Article\Filters\FollowerFilter;
use App\Modules\Rest\Data\Components\Article\Filters\TagFilter;
use App\Modules\Rest\Data\Components\Article\Filters\UserFilter;
use Illuminate\Http\Request;


class FilterParser
{
    private static $filters = [
        'user' => UserFilter::class,
        'tags' => TagFilter::class,
        'article'=>ArticleFilter::class,
        'follower'=>FollowerFilter::class,
    ];

    public static function parse(Request $request)
    {
        $arrFilters = [];
        $reqFilters = $request->input('filters');
        if (!$reqFilters) {
            // throw error
        }
        foreach ($reqFilters as $reqKey => $reqVal) {
            foreach (self::$filters as $key => $val) {
                if ($reqKey === $key) {
                    $filter = new $val();
                    $filter->injectData($request);
                    $arrFilters[] = $filter;
                }
            }
        }
        return $arrFilters;
    }
}
