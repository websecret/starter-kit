<?php

namespace App\Providers;

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
            ->namespace($this->namespace)
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
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    public function register()
    {
        Route::macro('adminGroup', function ($model, $options = []) {
            $namespace = str_replace('App\Models\\', '', $model);
            $parts = explode('\\', $namespace);
            $routeParts = array_map(function ($part) {
                return kebab_case(str_plural($part));
            }, $parts);
            $options['prefix'] = array_get($options, 'prefix', implode('/', $routeParts));
            $options['as'] = array_get($options, 'as', implode('.', $routeParts) . '.');
            Route::group($options, function () use ($model) {
                Route::admin($model);
            });
        });
        Route::macro('admin', function ($model) {
            $namespace = str_replace('App\Models\\', '', $model);
            $parts = explode('\\', $namespace);
            $modelName = camel_case(last($parts));
            //Route::model($modelName, $model);
            Route::get('/', $namespace . 'Controller@index')->name('index');
            Route::group(['prefix' => 'order', 'as' => 'order'], function ($route) use ($namespace) {
                Route::get('/', $namespace . 'Controller@order');
                Route::post('/', $namespace . 'Controller@reorder');
            });
            Route::get('add', $namespace . 'Controller@form')->name('add');
            Route::post('store/{' . $modelName . '?}', $namespace . 'Controller@store')->name('store');
            Route::group(['prefix' => '{' . $modelName . '}'], function ($route) use ($namespace) {
                $route->get('edit', $namespace . 'Controller@form')->name('edit');
                $route->get('delete', $namespace . 'Controller@delete')->name('delete');
                $route->post('fast', $namespace . 'Controller@fast')->name('fast');
            });
        });
    }
}
