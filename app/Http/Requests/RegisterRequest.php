<?php

namespace App\Http\Requests;

class RegisterRequest extends FromRequest
{
    public function rules()
    {
        return [
            "username" => "required|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6"
        ];
    }
}
