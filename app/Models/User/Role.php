<?php

namespace App\Models\User;

use Silber\Bouncer\Database\Role as BaseRole;

class Role extends BaseRole
{
    const ROLE_ADMIN = 'admin';

    const ROLES = [
        self::ROLE_ADMIN,
    ];
}