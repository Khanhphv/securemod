<?php

return [

    'characters' => '2346789abcdefghjmnpqrtuxyz',

    'default'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 34,
        'quality'   => 100,
        'fontColors' => ['#e2a518'],
        'bgImage'   => false,
        'bgColor'   => '#FFF',
    ],

    'flat'   => [
        'length'    => 6,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
        'lines'     => 2,
        'bgImage'   => false,
        'bgColor'   => '#000',
        'fontColors'=> ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'contrast'  => -5,
    ],

    'mini'   => [
        'length'    => 3,
        'width'     => 60,
        'height'    => 32,
    ],

    'inverse'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 34,
        'quality'   => 90,
        'sensitive' => true,
        'angle'     => 12,
        'sharpen'   => 10,
        'blur'      => 2,
        'invert'    => true,
        'contrast'  => -5,
    ]

];
