<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikePost extends Model
{
    protected $fillable = ['post_id', 'like_count'];
    protected $table = 'like_post';
}
