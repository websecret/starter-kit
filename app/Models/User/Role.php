<?php

namespace App\Models\User;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    const ROLE_ADMIN = 'admin';

    const ROLES = [
        self::ROLE_ADMIN,
    ];
}