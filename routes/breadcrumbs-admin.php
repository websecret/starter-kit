<?php

Breadcrumbs::for('admin.home.index', function ($trail) {
    $trail->push(__('sections.home.title'), route('admin.home.index'));
});

Breadcrumbs::forAdmin(\App\Models\User\User::class);

Breadcrumbs::forAdmin(\App\Models\Page::class);
