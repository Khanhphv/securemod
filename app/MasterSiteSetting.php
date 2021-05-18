<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterSiteSetting extends Model
{
    protected $fillable = ['logo_mini', 'text_logo', 'favicon', 'about_us', 'for_support', 'verified_seller_logo', 'verified_seller_url'];
}
