<?php

namespace App\Http\Requests;

class VerifyEmailResetPasswordRequest extends FromRequest
{
    public function rules()
    {
        return [
            "new_password" => "required|min:6"
        ];
    }
}
