<?php

namespace App\Models\Traits;

trait RouteSluggable
{
    public function getRouteKeyName()
    {
        if (request()->is('api*')) {
            return 'slug';
        }

        return 'id';
    }
}