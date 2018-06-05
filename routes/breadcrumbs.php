<?php

Breadcrumbs::for('admin.home.index', function ($trail) {
    $trail->push(__('sections.home.title'), route('admin.home.index'));
});

Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.home.index');
    $trail->push(__('sections.users.title'), route('admin.users.index'));
});
Breadcrumbs::for('admin.users.add', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push(__('sections.users.add'), route('admin.users.add'));
});
Breadcrumbs::for('admin.users.edit', function ($trail, $model) {
    $trail->parent('admin.users.index');
    $trail->push(__('sections.users.edit'), route('admin.users.edit', $model));
});

Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->parent('admin.home.index');
    $trail->push(__('sections.pages.title'), route('admin.pages.index'));
});
Breadcrumbs::for('admin.pages.add', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push(__('sections.pages.add'), route('admin.pages.add'));
});
Breadcrumbs::for('admin.pages.edit', function ($trail, $model) {
    $trail->parent('admin.pages.index');
    $trail->push(__('sections.pages.edit'), route('admin.pages.edit', $model));
});