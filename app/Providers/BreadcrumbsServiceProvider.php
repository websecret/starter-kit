<?php

namespace App\Providers;

use Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsServiceProvider as ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        parent::register();
        Breadcrumbs::macro('forAdmin', function ($routeName, $section = null) {
            $section = is_null($section) ? $routeName : $section;
            Breadcrumbs::for('admin.' . $routeName . '.index', function ($trail) use($routeName, $section) {
                $trail->parent('admin.home.index');
                $trail->push(__('sections.' . $section . '.title'), route('admin.' . $routeName .'.index'));
            });
            Breadcrumbs::for('admin.' . $routeName . '.add', function ($trail) use($routeName, $section) {
                $trail->parent('admin.' . $routeName . '.index');
                $trail->push(__('sections.' . $section . '.add'), route('admin.' . $routeName .'.add'));
            });
            Breadcrumbs::for('admin.' . $routeName . '.edit', function ($trail, $model) use($routeName, $section) {
                $trail->parent('admin.' . $routeName . '.index');
                $trail->push(__('sections.' . $section . '.edit'), route('admin.' . $routeName .'.edit', $model));
            });
        });
    }
}
