<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadTag extends Model
{
    protected $fillable = ['type', 'type_id','header_title', 'header_description'];
}
