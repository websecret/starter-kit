<?php

namespace App\Models\User;

use App\Models\Traits\Nameable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Ultraware\Roles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;
    use Nameable;

    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) $this->attributes['password'] = Hash::make($value);
    }

    public function getRoleAttribute()
    {
        return $this->getRoles()->first();
    }

    public function canAccessRoute($routeName)
    {
        $accessibleRoutePatterns = config('admin.permitted-routes.' . $this->role->slug, []);

        return str_is($accessibleRoutePatterns, $routeName);
    }
}
