<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticateContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizeContract;
use Laravel\Passport\HasApiTokens;


class Users extends Model implements AuthenticateContract, AuthorizeContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    protected $fillable = [
        'username', 'email', 'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }

    protected $hidden = [
        'password', "id",
    ];

    public function Channels()
    {
        return $this->hasOne(Channels::class);
    }

    public function Users_Channels()
    {
        return $this->belongsToMany(Channels::class, "users_channels", "users_id");
    }

    public function findForPassport($username)
    {
        return $this->where([['username' , $username]])->first();
    }
}
