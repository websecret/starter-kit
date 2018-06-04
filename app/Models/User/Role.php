<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use \Ultraware\Roles\Models\Role as BaseRole;

class Role extends BaseRole
{
    const ROLE_ADMIN = 'admin';

    const ROLES = [
        self::ROLE_ADMIN,
    ];
}