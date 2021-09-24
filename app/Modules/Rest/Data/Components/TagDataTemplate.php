<?php

namespace App\Modules\Rest\Data\Components;

use App\Models\Articles;
use App\Models\Tags;
use App\Modules\Rest\Data\DataTemplateInterface;

class TagDataTemplate implements DataTemplateInterface
{
    private $tags = [];
    public function validate()
    {
        return null;
    }

    public function bootstrap()
    {
        $this->tags = Tags::all();

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
          return $response;
    }

}
