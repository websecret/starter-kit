<?php

namespace App\Providers;

use App\Services\Prettifier;
use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('dd', function ($data) {
            return "<?php dd($data) ;?>";
        });

        Blade::directive('dump', function ($data) {
            return "<?php dump($data) ;?>";
        });

        Blade::directive('price', function ($price) {
            return "<?= \App\Services\Prettifier::prettifyPrice($price); ?>";
        });

        Blade::directive('textarea', function ($text) {
            return "<?= \App\Services\Prettifier::prettifyTextArea($text); ?>";
        });

        Blade::directive('date', function ($date) {
            return "<?= \App\Services\Prettifier::prettifyDate($date); ?>";
        });

        Blade::directive('dateShort', function ($date) {
            return "<?= \App\Services\Prettifier::prettifyDateShort($date); ?>";
        });
    }

    public function register()
    {
        //
    }
}
