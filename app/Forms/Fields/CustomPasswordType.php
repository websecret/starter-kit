<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CustomPasswordType extends FormField
{

    protected function getTemplate()
    {
        return 'admin.partials.form.fields.password';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options['value'] = null;
        $options['attr']['class'] = 'form-control js-input-password__field';
        return parent::render($options, $showLabel, $showField, $showError);
    }
}