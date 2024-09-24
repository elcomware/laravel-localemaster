<?php

// config for Elcomware/LocaleMaster

return [

    'defaults'=>[
        'locale' => env('LOCALE_MASTER_DEFAULT', 'en'),
        'locales' => [
            'code' => env('LOCALE_CODE', 'en'),
            'name' => env('LOCALE_NAME', 'English'),
            'native_name' => env('LOCALE_NATIVE_NAME', 'English'),
            'direction' => env('LOCALE_DIRECTION', 'ltr'),
            'identifier' => env('LOCALE_IDENTIFIER', 'en_CM'),
            'precision' => env('LOCALE_DECIMAL_PRECISION', 2),
            'decimal_separator' => env('LOCALE_DECIMAL_SEPARATOR', '.'),
            'thousand_separator' => env('LOCALE_THOUSAND_SEPARATOR', ','),
            'currency_symbol' => env('LOCALE_CURRENCY_SYMBOL', 'FCFA'),
            'currency_name' => env('LOCALE_CURRENCY_NAME', 'Franc'),
            'currency_first' => env('LOCALE_CURRENCY_FIRST', false),
        ],
    ],

    'tables'=>[
        'locale'=>'locales'
    ],

    'models'=> [
        'user'=>'App\\Models\\User',
        'permission'=>'App\\Models\\Permission',
    ],

    'permissions'=>[
        //key => value (in data base)
        'create'=>'create',
        'viewAny'=>'viewAny',
        'view'=>'view',
        'update'=>'update',
        'delete'=>'delete',
    ]

];
