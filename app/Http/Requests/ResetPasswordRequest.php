<?php

namespace App\Http\Requests;

class ResetPasswordRequest extends FromRequest
{
    public function rules()
    {
        return [
            "email" => "required|email"
        ];
    }
}
