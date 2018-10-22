<?php

namespace App\Providers;

use App\Services\Model\Admin as AdminModel;
use App\Services\Model\API as APIModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace . '\Index')
            ->group(base_path('routes/index.php'));

        Route::middleware('web')
            ->namespace($this->namespace . '\Admin')
            ->prefix('admin')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->as('api.')
            ->middleware('api')
            ->namespace($this->namespace . '\API')
            ->group(base_path('routes/api.php'));
    }

    public function register()
    {
        Route::macro('adminGroup', function ($model, $options = []) {
            $adminModelService = new AdminModel($model);
            $options['prefix'] = array_get($options, 'prefix', $adminModelService->getRoutePath());
            $options['as'] = array_get($options, 'as', $adminModelService->getRouteName() . '.');
            Route::group($options, function () use ($model) {
                Route::admin($model);
            });
        });

        Route::macro('admin', function ($model) {
            $adminModelService = new AdminModel($model);
            $namespace = $adminModelService->getNamespace();
            $modelName = $adminModelService->getRouteModelName();
            Route::get('/', $namespace . 'Controller@index')->name('index');
            Route::group(['prefix' => 'order', 'as' => 'order'], function ($route) use ($namespace) {
                Route::get('/', $namespace . 'Controller@order');
                Route::post('/', $namespace . 'Controller@reorder');
            });
            Route::get('ajax-select', $namespace . 'Controller@ajaxSelect')->name('ajax-select');
            Route::get('add', $namespace . 'Controller@form')->name('add');
            Route::get('show/{' . $modelName . '}', $namespace . 'Controller@show')->name('show');
            Route::post('store/{' . $modelName . '?}', $namespace . 'Controller@store')->name('store');
            Route::group(['prefix' => '{' . $modelName . '}'], function ($route) use ($namespace) {
                $route->get('edit', $namespace . 'Controller@form')->name('edit');
                $route->get('delete', $namespace . 'Controller@delete')->name('delete');
                $route->post('fast', $namespace . 'Controller@fast')->name('fast');
            });
        });

        Route::macro('api', function ($model, $additionalRoutes = [], $except = null) {
            if ($except == null) {
                $except = ['store', 'update', 'destroy'];
            }
            $adminModelService = new APIModel($model);
            $namespace = $adminModelService->getNamespace();
            $modelPath = $adminModelService->getRouteModelPath();
            $options['prefix'] = $adminModelService->getRoutePath(false);
            $options['as'] = $adminModelService->getRouteName(false);
            Route::group($options, function () use ($namespace, $except, $additionalRoutes, $modelPath) {
                Route::group(['prefix' => $modelPath, 'as' => $modelPath], function() use($namespace, $additionalRoutes) {
                    foreach ($additionalRoutes as  $additionalRouteParams) {
                        $additionalRouteMethod = array_get($additionalRouteParams, 'method', 'get');
                        Route::$additionalRouteMethod($additionalRouteParams['path'], $namespace . 'Controller@' . $additionalRouteParams['@']);
                    }
                });
                Route::apiResource($modelPath, $namespace . 'Controller', [
                    'except' => $except,
                ]);
            });
        });
    }
}
