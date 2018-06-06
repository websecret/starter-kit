<?php

namespace App\Models\LocaleDepend;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;

class LocaleDepend extends Model
{
    protected $fillable = [
        'locale',
    ];

    public function dependable()
    {
        return $this->morphTo('dependable');
    }

    public static function getAvailableLocales()
    {
        return LaravelLocalization::getSupportedLocales();
    }
}