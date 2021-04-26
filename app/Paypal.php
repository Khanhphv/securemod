<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $table = 'paypal';
    protected $fillable = ['client_id', 'client_secret', 'status', 'name'];
}
