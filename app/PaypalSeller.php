<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalSeller extends Model
{
    protected $fillable = [
        'seller_name', 'discord',  'payment_options', 'more_infomation'
    ];
}
