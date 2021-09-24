<?php
if(!function_exists('rest')){
    function rest($code,array $data=[],$err)
    {
        if(!is_int($code)){
            throw new Error("Response code must be an Integer");
        }
        $response = [
            'status'=>$code,
            'data'=>count($data)?$data:null,
            'errors'=>($err)?$err['errors']:null,
            'message'=>($err)?array_pop($err['messages']):null,
        ];
       return response($response,$code);
    }
}
