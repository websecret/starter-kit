<?php

use App\Models\User\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::query()->delete();

        foreach (Role::ROLES as $key => $role) {
            Role::create([
                'name' => __("sections.users.users.roles.$role"),
                'slug' => $role,
            ]);
        }
    }
}