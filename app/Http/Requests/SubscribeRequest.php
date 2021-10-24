<?php

namespace App\Http\Requests;

class SubscribeRequest extends FromRequest
{
    public function rules()
    {
        return [
            "channels_id" => "required",
        ];
    }
}
