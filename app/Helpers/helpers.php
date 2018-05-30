<?php

if (!function_exists('test')) {
    function test($str)
    {

        return $str;
    }
}

if (!function_exists('admin_routes')) {
    function admin_routes($route, $controllerName, $modelName = null)
    {
        if (is_null($modelName)) {
            $modelName = camel_case($controllerName);
        }
        $route->get('/', $controllerName . 'Controller@index')->name('index');
        $route->get('add', $controllerName . 'Controller@form')->name('add');
        $route->post('store/{' . $modelName . '?}', $controllerName . 'Controller@store')->name('store');
        $route->group(['prefix' => '{' . $modelName . '}'], function ($route) use ($controllerName) {
            $route->get('edit', $controllerName . 'Controller@form')->name('edit');
            $route->get('delete', $controllerName . 'Controller@delete')->name('delete');
            $route->post('fast', $controllerName . 'Controller@fast')->name('fast');
        });
    }
}