<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikePost extends Model
{
    protected $fillable = ['post_id', 'user_id'];
    protected $table = 'user_like_post';
}
