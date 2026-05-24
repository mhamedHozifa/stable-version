<?php

return [
    'default' => 'clothing',

    'themes' => [
        'clothing' => [
            'views' => [
                'store' => 'products.index',
                'category' => 'products.index',
                'product' => 'products.show',
                'cart' => 'cart.index',
                'checkout' => 'cart.checkout',
            ],
            'css' => [
                'store' => 'css/themes/clothing/cloth.css',
                'cart' => 'css/themes/clothing/clothCart.css',
                'checkout' => 'css/themes/clothing/clothCheckout.css',
            ],
        ],

        'electronics' => [
            'views' => [
                'store' => 'products.index',
                'category' => 'products.index',
                'product' => 'products.show',
                'cart' => 'cart.index',
                'checkout' => 'cart.checkout',
            ],
            'css' => [
                'store' => 'css/themes/electronics/ele.css',
                'cart' => 'css/themes/electronics/eleCart.css',
                'checkout' => 'css/themes/electronics/eleCheckout.css',
            ],
        ],
    ],
];
