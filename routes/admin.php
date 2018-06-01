<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'role:admin'], function ($route) {

    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::admin('User');
    });

});

