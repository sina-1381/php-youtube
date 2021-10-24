<?php

namespace App\Models;

class Channels extends Model
{
    protected $fillable = [
        'name', 'description', "image",
    ];

    protected $hidden = [
    ];

    public function Videos()
    {
        return $this->hasMany(Videos::class);
    }

    public function Users()
    {
        return $this->belongsTo(Users::class);
    }

    public function Users_Channels()
    {
        return $this->belongsToMany(Users::class, "users_channels", "channels_id");
    }

}
