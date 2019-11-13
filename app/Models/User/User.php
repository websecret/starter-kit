<?php

namespace App\Models\User;

use Hash;
use App\Models\Traits\Nameable;
use App\Models\Traits\Orderable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Nameable;
    use Orderable;
    use Notifiable;
    use HasRolesAndAbilities;

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
        return $this->roles->first();
    }

    public function canAccessRoute($routeName)
    {
        $accessibleRoutePatterns = config('admin.permitted-routes.' . optional($this->role)->name, []);

        return str_is($accessibleRoutePatterns, $routeName);
    }
}
