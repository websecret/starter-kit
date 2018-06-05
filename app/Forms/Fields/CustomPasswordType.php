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
        $options = $this->getOptions();
        $options['value'] = null;
        $options['attr']['class'] = config('laravel-form-builder.defaults.field_class') . ' js-input-password__field';
        return parent::render($options, $showLabel, $showField, $showError);
    }
}