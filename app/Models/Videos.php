<?php

namespace App\Models;

class Videos extends Model
{
    protected $fillable = [
        'title', 'description', "video",
    ];

    protected $hidden = [
    ];
}

