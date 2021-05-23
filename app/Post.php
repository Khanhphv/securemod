<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'sumary','content', 'thumbnail', 'view'];

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
