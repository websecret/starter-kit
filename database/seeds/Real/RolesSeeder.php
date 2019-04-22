<?php

use App\Models\User\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::query()->delete();

        foreach (Role::ROLES as $role) {
            Role::create([
                'name' => $role,
                'title' => trans('sections.users.users.roles.' . $role)
            ]);
        }
    }
}