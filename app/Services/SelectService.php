<?php

namespace App\Services;

use App\Models\User\Role;

class SelectService
{
    public static function roles()
    {
        return Role::query()
            ->pluck('name', 'id')
            ->transform(function ($name) {
                return trans('sections.users.users.roles.'. $name);
            })
            ->toArray();
    }
}