<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\LikePost;
use App\User;

class Post extends Model
{
    protected $fillable = ['user_id', 'title','content', 'thumbnail', 'view', 'header_title', 'header_description'];

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function users_like()
    {
        return $this->belongsToMany(User::class, 'user_like_post');
    }

    public function like_post(){
        return $this->hasOne(LikePost::class);
    }
}
