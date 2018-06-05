<?php namespace App\Forms;

use App\Forms\Presenters\UserPresenter;
use App\Services\SelectService;
use Illuminate\Validation\Rule;

class UserForm extends AbstractForm
{
    public function getPresenters()
    {
        return [
            'admin' => UserPresenter::class,
        ];
    }

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