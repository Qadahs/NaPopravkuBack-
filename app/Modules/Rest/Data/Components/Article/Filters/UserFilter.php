<?php

namespace App\Modules\Rest\Data\Components\Article\Filters;

use App\Models\User;
use App\Modules\Rest\Data\Components\FilterInterface;
use App\Modules\Rest\Errors\Components\ServerError;
use App\Modules\Rest\Errors\ErrorTemplator;
use Illuminate\Http\Request;

class UserFilter implements FilterInterface
{
    private $id = 0;
    public  function filter($model)
    {
        return call_user_func_array(array($model,'where'),['users_id',$this->id]);
    }

    public function injectData(Request $request)
    {
        $id = $request->input('filters.user');
        if(!(int)$id)
        {
            ErrorTemplator::error(ServerError::class);
        }
        $this->setId((int)$id);

    }


    private function setId(string $id): void
    {
        $this->id = $id;
    }

}
