<?php
return [
    'email' => [
      'subject' => [
          'invoice' => 'Payment Successful'
      ],
      'name' => 'Securecheats',
      'email' => 'vietkhanh1310@gmail.com',
    ],
    'limited_times' => 3,
    'plus_views' => 1,
    'menu' => [
        '/home', '/balance', '/keys', '/keys', '/terms-of-services', '/post'
    ],
    'paypal_status' => [
        'completed' => 'COMPLETED'
    ],
    'action' => [
        'recharge_via_paypal' => 'CHARGE_VIA_PAYPAL',
        'recharge_via_coinpayment' => 'CHARGE_VIA_COINPAYMENTS',
        'recharge_via_lexhodings' => 'CHARGE_VIA_LEXHOLDINGS'
    ],
    'role_member' => [
        'member_name' => [
            'diamond' => 'Diamond',
            'platinum' => 'Platinum',
            'gold' => 'Gold',
            'silver' => 'Silver',
        ],
        'member_status' => [
            'diamond' => 3,
            'platinum' => 2,
            'gold' => 1,
            'silver' => 0,
        ],
        'discount' => [
            'diamond' => 0.1,
            'platinum' => 0.05,
            'gold' => 0.025,
            'silver' => 0,
        ],
        'icon' => [
            'diamond' => 'Diamond',
            'platinum' => 'Platinum',
            'gold' => 'Gold',
            'silver' => 'Silver',
        ]
        ],
        'coin_currencies' => [
            'BTC',
            'ETH',
            'USDT',
            'BCH',
        ]

];
