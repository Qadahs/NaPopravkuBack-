<?php

namespace App\Modules\Rest\Data\Components\Tag;

use App\Models\Articles;
use App\Models\Tags;
use App\Modules\Rest\Data\DataTemplateInterface;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\RestResponse;

class TagDataTemplate implements DataTemplateInterface
{
    private $tags = [];
    public function validate()
    {
    }

    public function bootstrap()
    {
        try {
            $this->tags = Tags::all();
        }
        catch (\Exception $e)
        {
            RestResponse::setError(ServerError::getError());
        }

    }

    public function template()
    {

      $response = [];
          foreach ($this->tags as $tag)
          {
              $response['tags'][]=[
                  'text'=>$tag->title,
                  'value'=>$tag->id
              ];
          }
          RestResponse::addData($response);
    }

}
