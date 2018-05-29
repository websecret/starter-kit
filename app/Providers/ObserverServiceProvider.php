<?php

namespace App\Providers;

use App\Models\Setting\Setting;
use App\Observers\SettingObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        Setting::observe(SettingObserver::class);
    }
    
    public function register()
    {
        //
    }
}
