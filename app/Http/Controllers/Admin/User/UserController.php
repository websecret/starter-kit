<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $count = true;
    protected function getModel()
    {
        return User::class;
    }

    public function getStoreValidationRules(Request $request, $model)
    {
        $rules = [
            'first_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignoreModel($model)
            ],
            'role' => [
                'required',
                Rule::exists('roles', 'id'),
            ],
        ];

        if (!$model->exists) {
            $rules['password'][] = 'required';
        }

        return $rules;
    }

    protected function save(Request $request, $model)
    {
        $user = parent::save($request, $model);

        $user->assign(array_wrap($request->input('role')));

        return $user;
    }
}