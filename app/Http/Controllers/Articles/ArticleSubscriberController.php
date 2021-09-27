<?php

namespace App\Http\Controllers\Articles;

use App\Models\Subscriber;
use App\Modules\Rest\Data\Components\Article\ArticleDataTemplate;
use App\Modules\Rest\Data\Components\Article\Filters\FollowerFilter;
use App\Modules\Rest\Data\Components\FilterParser;
use App\Modules\Rest\Data\DataTemplator;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use App\Modules\Rest\RestResponse;
use Illuminate\Http\Request;


class ArticleSubscriberController
{
        public function post(Request $request,ArticleDataTemplate $articleDataTemplate)
        {

           $filters =  FilterParser::parse($request);
           $articleDataTemplate->setFilters($filters);
           DataTemplator::data($articleDataTemplate);
           RestResponse::response();
        }
        public function follow(Request $request)
        {
            $id = (int)$request->input('id');
            if($id)
            {
                try{
                    Subscriber::create([
                        'users_id'=>$request->user()->id,
                        'follower_id'=>$id
                    ]);
                    RestResponse::response();
                }
                catch (\Exception $e)
                {
                    ErrorTemplator::error(ServerError::class);
                }

            }
            ErrorTemplator::error(ServerError::class);
        }
        public function unfollow(Request $request)
        {
            $id = (int)$request->input('id');
            if($id)
            {
                try{
                   $subsriber = Subscriber::where([['follower_id',$id],['users_id',$request->user()->id]])->get();
                    if(count($subsriber))
                    {
                        Subscriber::where([['follower_id',$id],['users_id',$request->user()->id]])->delete();
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
        public function checkFollow(Request $request)
        {
            $id = (int)$request->input('id');

            if($id)
            {

                try{
                   $subscriber = Subscriber::where([['follower_id',$id],['users_id',$request->user()->id]])->get();
                   if(count($subscriber))
                   {
                       RestResponse::addData(['subscriber'=>1]);
                       RestResponse::response();
                   }
                   else
                   {
                       RestResponse::addData(['subscriber'=>0]);
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
