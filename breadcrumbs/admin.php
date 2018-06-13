<?php

Breadcrumbs::for('admin.home.index', function ($trail) {
    $trail->push(__('sections.home.title'), route('admin.home.index'));
});

Breadcrumbs::forAdmin('users.users', 'users');
Breadcrumbs::forAdmin('pages');