<?php

return [
    'title' => env('APP_NAME', env('ADMIN_TITLE')),
    'logo' => 'images/websecret/logo-dark.svg',
    'fluid' => false,
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
        [
            'route' => 'admin.pages.index',
            'routeParams' => [],
            'icon' => 'fe fe-align-justify',
            'text' => 'Страницы',
            'exact' => false,
        ],
    ],
];