<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateUid()
    {
        return (string) Str::uuid();
    }

    public function sanitizeData($data)
    {

        $filters = [
            'name'     =>  'trim|escape|capitalize|strip_tags',
            'city'    =>  'trim|escape|capitalize|strip_tags',
            'state'     =>  'trim|escape|capitalize|strip_tags',
            'country'         =>  'trim|escape|capitalize|strip_tags',
            'address'   =>  'strip_tags',
            'phone'         =>  'digit',
            'vehicle_no'     =>  'trim|escape|strip_tags',
            'vehicle_name'     =>  'trim|escape|capitalize|strip_tags',
            'vehicle_model'     =>  'trim|escape|capitalize|strip_tags',
        ];

        $newData = \Sanitizer::make($data, $filters)->sanitize();

        return $newData;
    }
}
