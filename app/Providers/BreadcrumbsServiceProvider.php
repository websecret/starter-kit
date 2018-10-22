<?php

namespace App\Providers;

use App\Services\Model\Admin as AdminModel;
use Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsServiceProvider as ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        parent::register();
        Breadcrumbs::macro('forAdmin', function ($model, $parentModel = null) {
            $adminModelService = new AdminModel($model);
            $parentRouteName = 'admin.home.index';
            if($parentModel) {
                $parentRouteName = 'admin.' . (new AdminModel($parentModel))->getRouteName() . '.index';
            }
            $routeName = 'admin.' . $adminModelService->getRouteName();
            $section = $adminModelService->getSectionPath();
            Breadcrumbs::for($routeName . '.index', function ($trail) use ($routeName, $parentRouteName, $section) {
                $trail->parent($parentRouteName);
                $trail->push(__($section . '.title'), route($routeName . '.index'));
            });
            Breadcrumbs::for($routeName . '.order', function ($trail) use ($routeName, $section) {
                $trail->parent($routeName . '.index');
                $trail->push(__('theme.order'), route($routeName . '.order'));
            });
            Breadcrumbs::for($routeName . '.add', function ($trail) use ($routeName, $section) {
                $trail->parent($routeName . '.index');
                $trail->push(__($section . '.add'), route($routeName . '.add'));
            });
            Breadcrumbs::for($routeName . '.edit', function ($trail, $model) use ($routeName, $section) {
                $trail->parent($routeName . '.index');
                $trail->push(__($section . '.edit'), route($routeName . '.edit', $model));
            });
        });
    }
}
