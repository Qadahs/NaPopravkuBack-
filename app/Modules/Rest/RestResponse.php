<?php

namespace App\Modules\Rest;

use App\Modules\Rest\Errors\ApplicationErrors;

class RestResponse
{
    public static function response($code,array $data=[],array $errors = [],$message='')
    {
        if(!is_string($message))
        {
            throw new \Error('Parameter $message must be string!');
        }
        $err = null;
        try
        {
            $err = ApplicationErrors::sendError($errors);
        }
        catch (\Error $e)
        {
            $err=ApplicationErrors::sendError(['serverError']);
        }
        $response = [
            'status'=>(!$err)?$code:array_pop($err['codes']),
            'data'=>count($data)?$data:null,
            'errors'=>($err)?$err['errors']:null,
            'message'=>($err)?array_pop($err['messages']):$message,
        ];
        return response($response,$code);
    }

}
