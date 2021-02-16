<?php

namespace App\API;

class Apierror
{
    public static function errorMassage($message, $code){
        return [
            'msg' => $message,
            'code' => $code
        ];
    }
}