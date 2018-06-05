<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Ultraware\Roles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) $this->attributes['password'] = Hash::make($value);
    }

    public function getFullNameAttribute()
    {
        $data = [];
        $fields = ['last_name', 'first_name', 'middle_name'];

        foreach ($fields as $field) {
            $data[] = $this->$field;
        }

        return implode(' ', array_filter($data));
    }

    public function getRoleAttribute()
    {
        return $this->getRoles()->first();
    }
}