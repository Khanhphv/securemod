<?php

namespace SellySample;

use Selly as SE;

class Selly
{
    public static function client()
    {
        SE\Client::authenticate(env('SELLY_EMAIL'), env('SELLY_API_KEY'));
    }
}
