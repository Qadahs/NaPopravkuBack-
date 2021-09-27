<?php

namespace App\Modules\Rest\Data\Components\Article\Filters;

use App\Models\Subscriber;
use App\Modules\Rest\Data\Components\FilterInterface;
use Illuminate\Http\Request;

class FollowerFilter implements FilterInterface
{
    private $userID = 0;
    public function filter($model)
    {
       $subscribers = Subscriber::where('users_id',$this->userID)->get();
       $subscribersId = [];
       foreach ($subscribers as $subscriber)
       {
           $subscribersId[] = $subscriber->follower_id;
       }
       return $model->whereIn('users_id',$subscribersId);
    }

    public function injectData(Request $request)
    {
       $this->userID=$request->user()->id;
    }

}
