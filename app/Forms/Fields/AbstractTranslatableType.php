<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;
use LaravelLocalization;

abstract class AbstractTranslatableType extends FormField
{

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options = array_merge($options, $this->getTranslatableOptions());
        return parent::render($options, $showLabel, $showField, $showError);
    }

    protected function getTranslatableOptions()
    {
        $this->setOption('required', false);
        $options = $this->getOptions();
        $options['locales'] = LaravelLocalization::getSupportedLocales();
        $options['locale'] = LaravelLocalization::getCurrentLocale();
        $options['attr']['class'] = config('laravel-form-builder.defaults.field_class') . ' js-translatable__input';
        $options['attr']['data-name'] = $this->getName();
        return $options;
    }

    public function getValidationRules()
    {
        $rules = parent::getValidationRules();
        $data = [
            'rules' => [],
            'attributes' => [],
            'error_messages' => [],
        ];
        $locale = LaravelLocalization::getCurrentLocale();
        foreach (array_get($rules, 'rules', []) as $key => $value) {
            $data['rules'][$key . '.' . $locale] = $value;
        }
        foreach (array_get($rules, 'attributes', []) as $key => $value) {
            $data['attributes'][$key . '.' . $locale] = $value;
        }
        foreach (array_get($rules, 'error_messages', []) as $key => $value) {
            $data['error_messages'][$key . '.' . $locale] = $value;
        }
        return $data;
    }
}