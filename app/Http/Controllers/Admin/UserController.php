<?php

namespace App\Http\Controllers\Admin;

use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function getModel()
    {
        return User::class;
    }

    protected function save(Request $request, $model)
    {
        $user = parent::save($request, $model);
        $user->syncRoles(array_wrap($request->input('role')));

        return $user;
    }
}