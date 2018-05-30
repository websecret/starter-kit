<?php

return [
    'title' => env('APP_NAME', env('ADMIN_TITLE')),
    'logo' => 'images/websecret/logo-dark.svg',
    'menu' => [
        [
            'route' => 'admin.home.index',
            'routeParams' => [],
            'icon' => 'fe fe-home',
            'text' => 'Главная',
            'exact' => true,
        ],
        [
            'route' => 'admin.users.index',
            'routeParams' => [],
            'icon' => 'fe fe-users',
            'text' => 'Пользователи',
            'exact' => false,
        ],
    ],
];