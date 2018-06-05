<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class BooleanType extends FormField
{

    protected function getTemplate()
    {
        return 'admin.partials.form.fields.boolean';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options = $this->getOptions();
        $options['attr']['class'] = 'js-form__input custom-control-input';
        return parent::render($options, $showLabel, $showField, $showError);
    }
}