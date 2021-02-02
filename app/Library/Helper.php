<?php

function hoursToDays($hours) {
    $string = '';
    $day = $hours / 24;
    if ($day > 0) {
        $string .= $day . " ngày";
        $hours = $hours % 24;
    }
    if ($hours > 0) {
        $string .= $hours." giờ";
    }
    return $string;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}