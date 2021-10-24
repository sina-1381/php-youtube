<?php

namespace App\Http\Requests;

class UpdateProfileRequest extends FromRequest
{
    public function rules()
    {
        return [
            "name" => "",
            "description" => "",
            "image" => "image|max:5000|mimes:jpeg"
        ];
    }
}
