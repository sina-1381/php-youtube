<?php

namespace App\Http\Requests;

class UpdateProfileRequest extends FromRequest
{
    public function rules()
    {
        return [
            "name" => "required|min:6",
            "description" => "required|min:6",
        ];
    }
}
