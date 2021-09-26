<?php

namespace App\Modules\Rest;

use App\Modules\Rest\Errors\ErrorTemplator;

class RestResponse
{
    private static $body = [
        'data'=>[],
        'errors'=>[],
        'message'=>''
    ];
    private static $code = 200;
//    public static function response($code,array $data=[],array $errors = [],$message='')
//    {
//        if(!is_string($message))
//        {
//            throw new \Error('Parameter $message must be string!');
//        }
//        $err = null;
//        try
//        {
//            $err = ErrorTemplator::sendError($errors);
//        }
//        catch (\Error $e)
//        {
//            $err=ErrorTemplator::sendError(['serverError']);
//        }
//        $response = [
//            'status'=>(!$err)?$code:array_pop($err['codes']),
//            'data'=>count($data)?$data:null,
//            'errors'=>($err)?$err['errors']:null,
//            'message'=>($err)?array_pop($err['messages']):$message,
//        ];
//        return response($response,$response['status']);
//    }
    public static function addData(array $data)
    {
        self::$body['data'] = array_merge(self::$body['data'],$data);
    }
    public static function setError(array $error)
    {
        self::$body['data']=[];
        self::$body['errors']=$error;
        response(self::$body,self::$code)->send();
        die;
    }
    public static function response()
    {
        response(self::$body,self::$code)->send();
        die;
    }

    /**
     * @param int $code
     */
    public static function setCode(int $code): void
    {
        self::$code = $code;
    }

    /**
     * @param string $message
     */
    public static function setMessage(string $message): void
    {
        self::$body['message'] = $message;
    }

}
