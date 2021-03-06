<?php

return [
    'home' => [
        'title' => 'Главная',
    ],

    'login' => [
        'title' => 'Авторизация',
    ],

    'users' => [
        'users' => [
            'title' => 'Пользователи',
            'add' => 'Добавление пользователя',
            'add_button' => 'Добавить пользователя',
            'edit' => 'Редактирование пользователя',
            'roles' => [
                \App\Models\User\Role::ROLE_ADMIN => 'Администратор',
            ],
            'count' => ':count пользователь|:count пользователя|:count пользователей',
        ],
    ],

    'pages' => [
        'title' => 'Страницы',
        'add' => 'Добавление страницы',
        'add_button' => 'Добавить страницу',
        'edit' => 'Редактирование страницы',
        'not_found' => 'Страницы не найдены',
        'order' => 'Сортировка страниц',
        'order_button' => 'Отсортировать страницы',
    ],

    'sections' => [
        'title' => 'Разделы',
        'edit' => 'Редактирование',
    ],

    'settings' => [
        'title' => 'Настройки',
        'edit' => 'Редактирование настроек',
    ],
];