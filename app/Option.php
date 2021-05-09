<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'option', 'value',  'created_at','updated_at','locate'
    ];
}
