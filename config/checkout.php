<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Delivery Methods
    |--------------------------------------------------------------------------
    */
    'delivery_methods' => [
        'foxpost' => [
            'label' => 'Csomagautómata',
            'info' => '1500 Ft',
            'icon'  => 'inbox',
            'price' => 1500,
        ],
        'hazhozszallitas' => [
            'label' => 'Házhozszállítás',
            'info' => '2500 Ft',
            'icon'  => 'truck',
            'price' => 1500,
        ],
        'szemelyes' => [
            'label' => 'Személyes átvétel',
            'info' => 'Budapest',
            'icon'  => 'user-circle',
            'price' => 0,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    */
    'payment_methods' => [
        'barion' => [
            'label' => 'Bankkártya',
            'info' => 'Barion',
            'icon'  => 'credit-card',
        ],
        'atutalas' => [
            'label' => 'Átutalás',
            'info' => 'OTP Bank',
            'icon'  => 'home-dollar',
        ],
        'cod' => [
            'label' => 'Utánvét',
            'info' => 'Személyes',
            'icon'  => 'coins',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Order Statuses
    |--------------------------------------------------------------------------
    */
    'order_statuses' => [
        'pending' => [
            'label' => 'Függőben',
            'color' => 'warning',
        ],
        'done' => [
            'label' => 'Elkészült',
            'color' => 'success',
        ],
        'cancelled' => [
            'label' => 'Törölve',
            'color' => 'danger',
        ],
    ],

];
