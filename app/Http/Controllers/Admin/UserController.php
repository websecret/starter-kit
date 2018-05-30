<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected function getModel()
    {
        return User::class;
    }

    protected function redirectToAfterSave($model)
    {
        return route('admin.users.index');
    }

    protected function redirectToAfterDelete()
    {
        return route('admin.users.index');
    }

    protected function save(Request $request, $model)
    {
        $data = $request->except(['password']);
        if ($password = $request->input('password')) {
            $data['password'] = $password;
        }
        $model->fill($data)->save();
        return $model;
    }
}
