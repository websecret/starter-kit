<?php

namespace App\Models\LocaleDepend;

trait DependsLocale
{
    public function localeDepends()
    {
        return $this->morphMany(LocaleDepend::class, 'dependable');
    }
}