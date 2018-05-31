<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::query()->delete();

        User::query()->create([
            'first_name' => 'Веб Секрет',
			'email' => 'info@websecret.by',
            'password' => config('websecret.password'),
        ]);

    }
}
