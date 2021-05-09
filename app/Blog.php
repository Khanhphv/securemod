<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
     protected $fillable = [
        'title', 'thumbnail', 'game_id', 'content', 'user_id'
    ];
}
