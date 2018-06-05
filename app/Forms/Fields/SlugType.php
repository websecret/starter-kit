<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class SlugType extends FormField
{

    protected function getTemplate()
    {
        return 'admin.partials.form.fields.slug';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options = $this->getOptions();
        $options['attr']['class'] = config('laravel-form-builder.defaults.field_class') . ' js-input-slug__field';
        $options['attr']['data-slug-from'] = json_encode(array_get($options, 'slug.from', []));
        $options['locked'] = array_get($options, 'slug.locked', false);
        return parent::render($options, $showLabel, $showField, $showError);
    }
}