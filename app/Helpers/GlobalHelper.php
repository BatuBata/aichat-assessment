<?php

if (!function_exists('makeResponse')) {
    
    function makeResponse($status = true, $message = 'success', $data = [], $code = 200)
    {
        return [
            'code'              => $code,
            'status'            => $status,
            'message'           => $message,
            'data'              => $data,
        ];
    }

}