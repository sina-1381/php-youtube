<?php

namespace App\Http\Requests;

class ChangePasswordRequest extends FromRequest
{
    public function rules()
    {
        return [
            "password" => "required|min:6",
            "new_password" => "required|min:6"
        ];
    }
}
