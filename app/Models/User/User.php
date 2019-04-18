<?php

namespace App\Models\User;

use App\Models\Traits\Orderable;
use Hash;
use App\Models\Traits\Nameable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Nameable;
    use Orderable;
    use Notifiable;

    protected $orderable = [
        'id',
    ];

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
        return $this->roles()->first();
    }

    public function canAccessRoute($routeName)
    {
        $accessibleRoutePatterns = config('admin.permitted-routes.' . optional($this->role)->name, []);

        return str_is($accessibleRoutePatterns, $routeName);
    }
}
