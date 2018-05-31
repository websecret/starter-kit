<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserController extends Controller
{
    protected function getModel()
    {
        return User::class;
    }
}