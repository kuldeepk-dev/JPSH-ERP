<?php

return [
    'name' => env('APP_NAME', 'InfixEdu'),
    'manifest' => [
        'name' => env('APP_NAME', 'InfixEdu'),
        'short_name' => env('APP_NAME', 'InfixEdu'),
        'start_url' => env('APP_URL', '/'),
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '72x72' => [
                'path' => 'public/images/icons/icon-72x72.png',
                'purpose' => 'any',
            ],
            '96x96' => [
                'path' => 'public/images/icons/icon-96x96.png',
                'purpose' => 'any',
            ],
            '144x144' => [
                'path' => 'public/images/icons/icon-144x144.png',
                'purpose' => 'any',
            ],
        ],
        'splash' => [
            '640x1136' => 'public/images/icons/splash-640x1136.png',
            '750x1334' => 'public/images/icons/splash-750x1334.png',
            '828x1792' => 'public/images/icons/splash-828x1792.png',
            '1125x2436' => 'public/images/icons/splash-1125x2436.png',
            '1242x2208' => 'public/images/icons/splash-1242x2208.png',
            '1242x2688' => 'public/images/icons/splash-1242x2688.png',
            '1536x2048' => 'public/images/icons/splash-1536x2048.png',
            '1668x2224' => 'public/images/icons/splash-1668x2224.png',
            '1668x2388' => 'public/images/icons/splash-1668x2388.png',
            '2048x2732' => 'public/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => env('APP_URL', '/'),
                'icons' => [
                    'src' => 'public/images/icons/icon-72x72.png',
                    'purpose' => 'any',
                ],
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => env('APP_URL', '/'),
            ],
        ],
        'custom' => [],
    ],
];
