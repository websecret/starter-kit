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
Route::any('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'admin'], function ($route) {

    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('new-counts', 'HomeController@newCounts')->name('home.new-counts');

    Route::group(['prefix' => 'upload', 'as' => 'upload.'], function () {
        Route::post('images', 'UploadController@images')->name('images');
        Route::post('froala-images', 'UploadController@froalaImages')->name('froala-images');
        Route::post('files', 'UploadController@files')->name('files');
        Route::get('delete-video/{video}', 'UploadController@deleteVideo')->name('delete-video');
    });

    Route::adminGroup(\App\Models\User\User::class);
    Route::adminGroup(\App\Models\Page::class);

});