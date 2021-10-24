<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Model extends BaseModel
{
    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }
}
