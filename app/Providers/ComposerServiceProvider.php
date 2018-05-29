<?php

namespace App\Providers;

use App\Models\Setting\Setting;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['index.*'], function ($view) {
            $setting = cache()->remember('setting', 30, function () {
                return Setting::first();
            });

            $view->with(compact('setting'));
        });

    }

    public function register()
    {

    }
}