<?php namespace App\Forms;

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
            ->add('password', 'custom-password', [
                'rules' => $this->getModel()->exists ? [] : [
                    'required',
                ],
            ]);
    }
}