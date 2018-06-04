<?php namespace App\Forms;

use App\Models\User\Role;
use App\Services\SelectService;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first_name', 'text', [
                'rules' => [
                    'required',
                ],
            ])
            ->add('last_name', 'text')
            ->add('middle_name', 'text')
            ->add('email', 'email', [
                'rules' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignoreModel($this->getModel()),
                ],
            ])
            ->add('role', 'select', [
                'choices' => SelectService::roles(),
                'rules' => [
                    'required',
                    Rule::exists('roles', 'id'),
                ],
                'selected' => $this->getModel()->role->id ?? null,
            ])
            ->add('password', 'custom-password', [
                'rules' => $this->getModel()->exists ? [] : [
                    'required',
                ],
            ]);
    }
}