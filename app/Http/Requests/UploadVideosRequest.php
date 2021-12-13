<?php

namespace App\Http\Requests;

class UploadVideosRequest extends FromRequest
{
    public function rules()
    {
        return [
            "title" => "required",
            "description" => "required",
        ];
    }
}
