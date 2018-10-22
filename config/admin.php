<?php

use App\Models\User\Role;

return [
    'title' => env('ADMIN_TITLE', env('APP_NAME')),
    'logo' => 'assets/admin/images/websecret/logo-dark.svg',
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
            'route' => 'admin.users.users.index',
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

    'permitted-routes' => [
        Role::ROLE_ADMIN => '*',
    ],
];