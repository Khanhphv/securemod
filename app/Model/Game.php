<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['id', 'name', 'description', 'thumb_image'];

}
