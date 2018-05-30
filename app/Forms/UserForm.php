<?php namespace App\Forms;

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
                    'email:unique,users,email,' . $this->getModel()->id
                ],
            ])
            ->add('password', 'custom-password', [
                'rules' => $this->getModel()->exists ? [] : [
                    'required',
                ],
            ]);
    }
}